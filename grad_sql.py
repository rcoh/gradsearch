import MySQLdb as mdb
import sys

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
    stmnt = "insert into prof (name, school, research_summary, lab_website," +\
    "personal_website) VALUES ('%s', '%s', '%s', '%s', '%s');" % (name,
        school, research_summary, lab_website, personal_website)
    import pdb; pdb.set_trace()
    self.cur.execute(stmnt)

  def insert(tablename, columns, values):
    col_str = '(%s)' % ','.join(['`%s`' % c for c in columns])
    val_str = '(%s)' % ','.join(["'%s'" % v for v in values])
    stmnt = "insert into %s %s VALUES %s;" % (tablename, col_str, val_str) 
#    INSERT INTO `rcoh+gradschool`.`prof` (`name`, `school`, `research_summary`, `lab_website`)
#    VALUES ('Some Prof', 'MIT', 'boopitiy boop', 'www.lol.com');


g = GradSql()
g.add_proffesor('My Ndfaadfadfame', 'MIT', 'Stuff I do', 'www.lol.com', 'www.lolol.com')
