import re
import urllib2
f = file('/home/rambhask/csailprof.html').read()
f=f.strip("\n")
prof_info=re.findall("<dt><a href=\"(.*?)\"><strong>Prof\. (.*?)</strong></a>,.*?,.*?,.*?<.*?>(.*?)</a>\s*</dt>\s*<dd>(.*?)<", f)
prof_info_alt= re.findall("<dt><strong><a href=\"(.*?)\">Prof\. (.*?)</a></strong>,(.*?),(.*?),.*?<.*?>(.*?)</a></dt>\s*<dd>(.*?)<",f)

import pdb; pdb.set_trace()
#for prof in prof_info:
    #urllib2.urlopen(prof[0])
#for prof in prof_info_alt:
    #urllib2.urlopen(prof[0])


#f=file('test123').read()
#fruit=re.search('apple', f)

#print fruit.group(0)
