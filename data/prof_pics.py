import re
import urllib
import pickle
import util

prof_pic_url =[]
prof_no_pics = file('profs_no_pics').read().split('\n')[:-1]
prof_no_pics = [p.strip() for p in prof_no_pics]

for prof in prof_no_pics:
    prof_pic_url.append('http://www.picsearch.com/index.cgi?' + urllib.urlencode([('q', prof), ('face','yes')]))

prof_pics = []
 
for name, prof_url in zip(prof_no_pics, prof_pic_url):
    f = util.dl_and_prep(prof_url)
    prof_pic_link = re.findall("img style=\"padding-top: [\d\.]*px;\" src=\"(.*?)\" height=\"\d*?\" width=\"\d*?\" alt=\".*?; result 1\"", f)[0]
    if not prof_pic_link:
        print prof_url
    prof_dict = {}
    prof_dict['name'] = name        
    prof_dict['image'] = prof_pic_link
    prof_pics.append(prof_dict)

pickle.dump(prof_pics, file('prof_dicts/images.dat', 'w'))
print "Done!"

