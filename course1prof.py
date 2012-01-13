import re
import urllib2
f = file('/home/rambhask/course1prof.html').read()
f=f.strip("\n")
prof_info=re.findall("<dt><a href=\"(.*?)\"><strong>Prof\. (.*?)</strong></a>,.*?,.*?,.*?<.*?>(.*?)</a>\s*</dt>\s*<dd>(.*?)<", f)
prof_info_alt= re.findall("<dt><strong><a href=\"(.*?)\">.*?\. (.*?)</a></strong>,(.*?),(.*?),.*?<.*?>(.*?)</a></dt>\s*<dd>(.*?)<",f)

#for prof in prof_info:
    #print prof[1]
import pdb; pdb.set_trace()
#for prof in prof_info:
    #urllib2.urlopen(prof[0])
#for prof in prof_info_alt:
    #urllib2.urlopen(prof[0])
