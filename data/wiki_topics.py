import re
import urllib2
import pickle
import util

import pdb; pdb.set_trace
seed_topics = ["robotics", "neurodevelopment"]
seed_topics = ["robotics"]
#seed_topics = ["computational biology"]
#seed_topics = ["neurodevelopment"]
dict = {}

 #also... list of ___ topics
 
for topic in seed_topics:
    #Check if there is an "outline of ___" page
    topic_underscored = topic.replace(" ","_")
    url_outline = "http://en.wikipedia.org/wiki/Outline_of_" + topic_underscored
    try:
        f1 = util.dl_and_prep(url_outline)
        print "outline exists!"
        print f1
        link_div=re.findall("#See_also(.*?)id=\"See_also\"", f1)
        print link_div
    except: 
        #outline_of page does not exist; look for see_also
        url = "http://en.wikipedia.org/wiki/" + topic_underscored.capitalize()
        f = util.dl_and_prep(url)
        link_div=re.findall("id=\"See_also\"(.*?)References", f)
    
    print topic
    links = re.findall("title=\"(.*?)\"",link_div[0])
    
    print links
    dict[topic] = links
    
#print dict

#pickle.dump(prof_dictionary_list, file('interests.dat', 'w'))
