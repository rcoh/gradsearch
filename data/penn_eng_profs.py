import re
import urllib
import pickle
import util

prof_profiles =[]
for value in range(2,109):
    prof_profiles.append("http://www.seas.upenn.edu/directory/profile.php?ID="+str(value))

penn_profs =[]
for prof in prof_profiles:
    f=util.dl_and_prep(prof)
    name =""
    title =""
    department =""
    email =""
    awards =""
    research=""
    education=""
    image=""
    if len(re.findall("<h1>(.*?)&nbsp;(.*?)</h1>",f))>0:
        first_name = re.findall("<h1>(.*?)&nbsp;(.*?)</h1>",f)[0][0]
        last_name = re.findall("<h1>(.*?)&nbsp;(.*?)</h1>",f)[0][1]
        name =first_name + last_name
        #print name
    if len(re.findall("<h2>(.*?)<br />",f))>0:
        title = re.findall("<h2>(.*?)<br />(.*?)<br />",f)[0][0]
        department = re.findall("<h2>(.*?)<br />(.*?)<br />",f)[0][1]
        #print title, department
    if len(re.findall("<a href=\"mailto:(.*?)\">",f))>0:
        email = re.findall("<a href=\"mailto:(.*?)\">",f)[0]
        #print email
    if len(re.findall("<strong>Honors and Awards:</strong> &nbsp;(.*?)<br",f))>0:
        awards = re.findall("<strong>Honors and Awards:</strong> &nbsp;(.*?)<br",f)[0]
        #print awards
    if len(re.findall("<strong>Research Expertise: </strong>(.*?)<p class=\"mainContent\">(.*?)</p>",f))>0:
        research =re.findall("<strong>Research Expertise: </strong>(.*?)<p class=\"mainContent\">(.*?)</p>",f)[0][0] + re.findall("<strong>Research Expertise: </strong>(.*?)<p class=\"mainContent\">(.*?)</p>",f)[0][1]
        #print research
    if len(re.findall("<strong>Education:</strong>(.*?)</p>",f))>0:
        education = re.findall("<strong>Education:</strong>(.*?)</p>",f)[0]
        #print education
    if len(re.findall("<div id=\"sidebar1\"><img src=\"(.*?)\"",f))>0:
        image = "http://www.seas.upenn.edu/directory/" + re.findall("<div id=\"sidebar1\"><img src=\"(.*?)\"",f)[0]
    penn_prof_dict ={}
    penn_prof_dict["name"] = name
    penn_prof_dict["email"] = email
    penn_prof_dict["title"] = title
    penn_prof_dict["department"] = department
    penn_prof_dict["awards"] = awards
    penn_prof_dict["research"] = research
    penn_prof_dict["education"] = education
    penn_prof_dict["image"] = image
    print penn_prof_dict
    penn_profs.append(penn_prof_dict)
    
pickle.dump(penn_profs, file('prof_dicts/penn_eng.dat', 'w'))
print "Done!"
