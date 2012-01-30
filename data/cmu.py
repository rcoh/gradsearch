#import scrapemark
import re
import util
import pickle

pat2 = """<tr><td valign="top"><div class="name"><a href="(.*?)>(.*?)</a></div><div>(.*?)</div>.*?<img src="(.*?)" alt.*?</td>.*?<td valign="top">.*?</td>.*?<td valign="top"><div>(.*?)</div></td></tr>"""
results = []
for c in range(ord('A'), ord('Z')):
  doc = util.dl_and_prep('http://people.cs.cmu.edu/Faculty/' + chr(c))
  print 'Got one'
  results += re.findall(pat2.strip(), doc)

final_dicts = [] 
for prof in results:
  pd = {}
  pd['source'] = "http://people.cs.cmu.edu" + prof[0]
  pd['name'] = prof[1][prof[1].find(',')+1:].strip() + ' ' + prof[1][:prof[1].find(',')].strip()
  pd['title'] = prof[2]
  pd['image'] = "http://people.cs.cmu.edu" + prof[3]
  pd['school'] = 'Carnegie Mellon'
  pd['department'] = 'Computer Science'
   
  research = util.research_interest_extractor(prof[4])
  if research:
    pd['keywords'] = research
  else:
    pd['research_summary'] = prof[4]
  final_dicts.append(pd)
 #website name title interests 

print 'got', len(final_dicts)
pickle.dump(final_dicts, file('prof_dicts/cmu.dat', 'w'))
