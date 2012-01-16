import MySQLdb as mdb
import sys
import re
prof_cols = ['name', 'school', 'research_summary', 'lab_website', 'personal_website', 'image']
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
    self.insert('prof', prof_info.keys(), prof_info.values())
    pid = self.prof_id(all_data['name'])
    assert pid != None
    for k in all_data['research_keywords']:
      assert not ',' in k
      assert isinstance(k, str)
      self.add_keyword(pid, k) 

  def add_keyword(self, prof_id, keyword):
    self.insert('keywords', ['prof_id', 'keyword'], [prof_id, keyword])

  def insert(self, tablename, columns, values):
    values = [re.escape(str(v)) for v in values]
    col_str = '(%s)' % ','.join(['`%s`' % c for c in columns])
    val_str = '(%s)' % ','.join(["'%s'" % v for v in values])
    stmnt = "insert into %s %s VALUES %s;" % (tablename, col_str, val_str) 
    self.cur.execute(stmnt)

  def update_or_insert_prof(self, name, school, research_summary, lab_website, personal_website):
    pass

  def prof_id(self, name):
    self.con.query('select id from prof where name=\'%s\'' % name)
    result = self.con.use_result()
    row = result.fetch_row()
    if len(row):
      return row[0][0]
    else:
      return None


g = GradSql()
#g.add_proffesor('Leah Alpert', '', 'School of Thought', 'www.lalpert.edu', 'www.lalpert.com')
print g.prof_id('Leah Alpert')
print g.prof_id('Lea2h Alpert')

