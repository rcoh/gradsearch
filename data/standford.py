import re
import pickle
import util
pat = """<tr VALIGN=TOP bgcolor='.*?'><td><a href='(.*?)'>(.*?)</a></td><td>(.*?)&nbsp;</td><td>(.*?)</td></tr>"""
results = []
for c in range(ord('A'), ord('[')):
  url = "http://soe.stanford.edu/research/pers_index_results.php?index=%s" % chr(c)
  doc = util.dl_and_prep(url)
  results += re.findall(pat, doc)

print len(results), 'total professors'
output = []
for prof in results:
  pd = {}
  pd['lab_website'] = 'http://soe.stanford.edu/research/%s' % prof[0]
  pd['name'] = prof[1]
  #extract the primary deptmartment from within the <b> tags
  if '<b>' in prof[2]:
    pd['department'] = re.findall('<b>(.*?)</b>', prof[2])[0]
  else:
    pd['department'] = util.remove_tags(prof[2])
  research = prof[3].replace('&nbsp;', '').strip()
  if len(research) > 0:
    pd['keywords'] = util.split_and_clean(research)

  personal_page = util.dl_and_prep(pd['lab_website'])
  summary = re.findall('<h3>Research Statement</h3><p>(.*?)</p><h3>Degrees</h3>', personal_page)
  if summary:
    pd['research_summary'] = util.remove_tags(summary[0]).strip()
  pd['image'] = re.findall('\'(images/photos_faculty_staff/.*?)\'', personal_page)[0]
  print pd['name'], pd['department']
  output.append(pd)

pickle.dump(output, file('standford', 'w'))
print 'Done!'
