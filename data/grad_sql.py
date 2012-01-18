import MySQLdb as mdb
import sys
import re
prof_cols = ['name', 'school', 'research_summary', 'lab_website', 'personal_website', 'image',
'title', 'department']
class GradSql(object):

  def __init__(self):
    try:
      self.con = mdb.connect('sql.mit.edu', 'rcoh', 'rcoh', 'rcoh+gradschool');
      with self.con:
        self.cur = self.con.cursor()

    except mdb.Error as e:
      print "Error %d: %s" % (e.args[0],e.args[1])
      sys.exit(1)
  
  def add_proffesor(self, name, school, research_summary, lab_website, personal_website):
    self.insert('prof', ['name', 'school', 'research_summary', 'lab_website', 'personal_website'],
        [name, school, research_summary, lab_website, personal_website])

  def add_proffesor(self, prof_info):
    all_data = dict(prof_info)  
    key_to_rm = []
    for k in prof_info:
      if not k in prof_cols:
        key_to_rm.append(k)

    for k in key_to_rm:
      del prof_info[k]
    pid = self.prof_id(all_data['name'])
    if not pid:
      self.insert('prof', prof_info.keys(), prof_info.values())
    else:
      self.update('prof', prof_info.keys(), prof_info.values(), 'id=%s' % pid)
    assert pid != None
    if 'keywords' in all_data:
      for k in all_data['keywords']:
        assert not ',' in k
        assert isinstance(k, str)
        self.add_keyword(pid, k) 
    print "added"

  def add_keyword(self, prof_id, keyword):
    kid = self.keyword_id(keyword)
    if not kid:
      self.insert('keywords', ['keyword'], [keyword])
      kid = self.keyword_id(keyword)

    self.insert('keywordmap', ['prof_id', 'keyword_id'], [prof_id, kid])

  def insert(self, tablename, columns, values):
    values = [self.con.escape_string(str(v)) for v in values]
    col_str = '(%s)' % ','.join(['`%s`' % c for c in columns])
    val_str = '(%s)' % ','.join(["'%s'" % v for v in values])
    stmnt = "insert into %s %s VALUES %s;" % (tablename, col_str, val_str) 
    self.cur.execute(stmnt)
  
  def insert_or_update_by_id(self, tablename, columns, value, match_id):
    exists = self.row_if_exists(tablename, match_id)
    if exists:
      self.update(tablename, columns, values, 'id=%s' % match_id)
    else:
      self.insert(tablename, columns, values)

  def update(self, tablename, columns, values, condition):
    values = [self.con.escape(str(v)) for v in values]
    setstr = ', '.join(['%s=%s' % (c, v) for c,v in zip(columns, values)])
    stmnt = "update %s set %s where %s" % (tablename, setstr, condition)

  def keyword_id(self, keyword):
    self.con.query('select id from keywords where keyword=%s' % self.con.escape(keyword))
    result = self.con.use_result()
    row = result.fetch_row()
    if len(row):
      return row[0][0]
    else:
      return None

  def prof_id(self, name):
    self.con.query('select id from prof where name=\'%s\'' % name)
    result = self.con.use_result()
    row = result.fetch_row()
    if len(row):
      return row[0][0]
    else:
      return None

  def row_if_exists(table, row_id):
    self.con.query('select id from %s where id=\'%s\'' % (table, row_id))
    result = self.con.use_result()
    row = result.fetch_row()
    if len(row):
      return row[0][0]
    else:
      return None

