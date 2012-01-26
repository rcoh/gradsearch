import re
import urllib
import pickle
import util

all_prof_links =[]
for num in range(0,48):
    f = util.dl_and_prep("http://vcresearch.berkeley.edu/faculty-expertise?page=%s&name=&expertise_area=&term_node_tid_depth=" % num)
    prof_links = ["http://vcresearch.berkeley.edu" + re.findall("class=\"views-field views-field-title\">.*?<a href=\"(.*?)\"",f)[i] for i in range(0, len(re.findall("class=\"views-field views-field-title\">.*?<a href=\"(.*?)\"",f)))]
    for prof_link in prof_links:
        all_prof_links.append(prof_link)

#print len(all_prof_links)
berkeley_profs = []
#import pdb; pdb.set_trace()
for prof in all_prof_links:
    name=''
    image=''
    title=''
    url=''
    email=''
    keywords=[]
    summary=''
    department=''
    g = util.dl_and_prep(prof)
    if len(re.findall("<h1 class=\"title\" id=\"page-title\">(.*?)</h1>",g))>0:
        name = re.findall("<h1 class=\"title\" id=\"page-title\">(.*?)</h1>",g)[0]
        #print name

    if len(re.findall("field field-type-filefield field-field-faculty-image\">.*?odd\">.*?img src=\"(.*?)\"",g))>0:
        image = re.findall("field field-type-filefield field-field-faculty-image\">.*?odd\">.*?img src=\"(.*?)\"",g)[0]
        #print image
        
    if len(re.findall("field field-type-text field-field-title\">.*?odd\">(.*?)</div>",g))>0:
        title = re.findall("field field-type-text field-field-title\">.*?odd\">(.*?)</div>",g)[0].strip()
        #print title
        
    if len(re.findall("field field-type-link field-field-faculty-url\">.*?odd\">.*?<a href=\"(.*?)\"",g))>0:
        url = re.findall("field field-type-link field-field-faculty-url\">.*?odd\">.*?<a href=\"(.*?)\"",g)[0].strip()
        #print url
        
    if len(re.findall("field field-type-text field-field-email\">.*?odd\">(.*?)</div>",g))>0:
        email = re.findall("field field-type-text field-field-email\">.*?odd\">(.*?)</div>",g)[0].strip()
        #print email
        
    if len(re.findall("Interest</h2>.*?<div class=\"pane-content\">(.*?)</div>",g))>0:
        interests = re.findall("Interest</h2>.*?<div class=\"pane-content\">(.*?)</div>",g)[0].strip()
        #print interests
        keywords =[]
        for w in interests.split(","):
            keywords.append(w.strip().lower())
        #print keywords
        
    if len(re.findall("Description</h2>.*?<div class=\"pane-content\">(.*?)</div>",g))>0:
        summary = re.findall("Description</h2>.*?<div class=\"pane-content\">(.*?)</div>",g)[0].strip()
        #print summary
        
    if len(re.findall("class=\"panel-pane pane-node-terms\" >.*?<div class=\"pane-content\">(.*?)</div>",g))>0:
        department = re.findall("class=\"panel-pane pane-node-terms\" >.*?<div class=\"pane-content\">(.*?)</div>",g)[0].strip()
        #print department
        
    berkeley_prof_dict={}
    berkeley_prof_dict['name']=name
    berkeley_prof_dict['image']=image
    berkeley_prof_dict['title']=title
    berkeley_prof_dict['personal_website']=url
    berkeley_prof_dict['email']=email
    berkeley_prof_dict['keywords']=keywords
    berkeley_prof_dict['research_summary']=summary
    berkeley_prof_dict['department']=department
    berkeley_prof_dict['source']=prof
    berkeley_prof_dict['school']= "UC-Berkeley"
    print berkeley_prof_dict
    if name:
        berkeley_profs.append(berkeley_prof_dict)
    
pickle.dump(berkeley_profs, file('prof_dicts/berkeley.dat', 'w'))
print "Done!"

