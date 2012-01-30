import re
import urllib
import pickle
import util

f = util.dl_and_prep("http://bbs.yale.edu/people/index.aspx")
prof_links = [re.findall("<li><a href=\"(.*?)\"",f)[i].replace(".profile", "-3.profile") for i in range(31,len(re.findall("<li><a href=\"(.*?)\"",f))-5)]

yale_profs = []
for prof in prof_links:
    g=util.dl_and_prep(prof)
    x=prof.replace("-3.profile", ".profile")
    h=util.dl_and_prep(prof.replace("-3.profile", ".profile"))
    print x
    image =""
    name =""
    title =""
    research =""
    keywords ="" 
    if len(re.findall("h3><img class=\"bordered floatrt\" src=\"(.*?)\"",h))>0:
        image = re.findall("h3><img class=\"bordered floatrt\" src=\"(.*?)\"",h)[0]
    if len(re.findall("name=\"keywords\" content=\"(.*?),(.*?),",g))>0:
        first_name = re.findall("name=\"keywords\" content=\"(.*?),(.*?),",g)[0][0]
        last_name = re.findall("name=\"keywords\" content=\"(.*?),(.*?),",g)[0][1]
        name = first_name.strip() + ' ' + last_name.strip()
        #print name
    if len(re.findall("</h1><p>(.*?)</p>",g))>0:
        title = re.findall("</h1><p>(.*?)</p>",g)[0]
        #print title
    if len(re.findall("Research Interests</h3><p>(.*?)</p>",g))>0:
        interests = re.findall("Research Interests</h3><p>(.*?)</p>",g)[0]
        interests = interests.replace(";", ",")
        #interests = interests.replace(".","")
        keywords =[]
        for w in interests.split(","):
            keywords.append(w.strip().lower())
        print keywords
    if len(re.findall("Research Summary</h3><p>(.*?)</p>",g))>0:
        summary = re.findall("Research Summary</h3><p>(.*?)</p>",g)[0]
        #print research_summary
    if len(re.findall("Extensive Research Description</h3><p>(.*?)</p>",g))>0:
        description = re.findall("Extensive Research Description</h3><p>(.*?)</p>",g)[0]
    #print research_description
    yale_prof_dict ={}
    yale_prof_dict["name"] = name
    #penn_prof_dict["email"] = email
    yale_prof_dict["title"] = title
    yale_prof_dict["department"] = "Department of Biological & Biomedical Sciences"
    #penn_prof_dict["awards"] = awards
    research_summary = ''
    l = [summary, description]
    for s in l:
        if s:
            research_summary += '<p>%s</p>' % s
    yale_prof_dict["research_summary"] = research_summary 
    yale_prof_dict["keywords"] = keywords
    #penn_prof_dict["education"] = education
    yale_prof_dict["image"] = image
    yale_prof_dict["school"] = "Yale University"
    yale_prof_dict["source"] = prof
    #print yale_prof_dict
    if name != '':
        yale_profs.append(yale_prof_dict)
        
pickle.dump(yale_profs, file('prof_dicts/yale.dat', 'w'))
print "Done!"
