import pickle
from grad_sql import GradSql
import sys

def fill_from_dict(loc):
  profs = pickle.load(file(loc))
  g = GradSql()
  for p in profs:
    g.add_proffesor(p)
  return len(profs)

if __name__ == "__main__":
  if len(sys.argv) == 1:
    print "no location specified. no data added."
  raw_input('I will load data from %s into the main database.  Enter to proceed.' % sys.argv[1])
  print fill_from_dict(sys.argv[1]), 'proffessors added'
  
