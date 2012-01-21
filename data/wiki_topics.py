import re
import urllib2
import pickle
import util

import pdb; pdb.set_trace
seed_topics = ["robotics", "neurodevelopment"]
seed_topics = ["robotics"]
#seed_topics = ["computational biology"]
#seed_topics = ["neurodevelopment"]
seed_topics = ["biochemistry"]
dict = {}

 #also... list of ___ topics
 
for topic in seed_topics:
    #Check if there is an "outline of ___" page
    topic_underscored = topic.replace(" ","_")
    url_outline = "http://en.wikipedia.org/wiki/Outline_of_" + topic_underscored
    try:
        f1 = util.dl_and_prep(url_outline)
        all_links=re.findall("title=\"(.*?)\"", f1)

        for index, link in enumerate(all_links):
            if "page does not exist" in link:
                all_links[index] = link[:-22]
        
        good_links = []
        bad_links = []
        for l in all_links:
            if (l.count(" ")>3) or (len(l)>35) or (":" in l) or ("(" in l) or ("Outline of" in l) or ("Index of" in l) or ("List of" in l):
                bad_links += [l]
            else:
                good_links += [l]

        print "BAD LINKS:\n"
        print "\n".join(bad_links)
        print "\nGOOD LINKS:\n"
        print "\n".join(good_links)

    except: 
        #outline_of page does not exist; look for see_also
        url = "http://en.wikipedia.org/wiki/" + topic_underscored.capitalize()
        f = util.dl_and_prep(url)
        link_div=re.findall("id=\"See_also\"(.*?)References", f)
    
    print topic
    #links = re.findall("title=\"(.*?)\"",link_div[0])
    
    #print links
    #dict[topic] = links
    
#print dict

#pickle.dump(prof_dictionary_list, file('interests.dat', 'w'))
