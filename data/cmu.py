import scrapemark
import re
import util
import pickle

pat2 = """<tr><td valign="top"><div class="name"><a href="(.*?)>(.*?)</a></div><div>(.*?)</div>.*?<img src="(.*?)" alt.*?</td>.*?<td valign="top">.*?</td>.*?<td valign="top"><div>(.*?)</div></td></tr>"""
results = []
for c in range(ord('A'), ord('Z')):
  doc = util.dl_and_prep('http://people.cs.cmu.edu/Faculty/' + chr(c))
  results += re.findall(pat2.strip(), doc)

final_dicts = [] 
for prof in results:
  pd = {}
  pd['personal_website'] = "http://people.cs.cmu.edu" + prof[0]
  pd['name'] = prof[1]
  pd['title'] = prof[2]
  pd['image'] = "http://people.cs.cmu.edu" + prof[3]
  pd['research_summary'] = prof[4] 
  final_dicts.append(pd)
 #website name title interests 

print 'got', len(final_dicts)
pickle.dump(final_dicts, file('cmu.dat', 'w'))
