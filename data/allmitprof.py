import re
import urllib2
import pickle
import util
all_prof_info =[]
courses = file('mitcourses.lst').read().split('\n')[:-1]
#HACKACAKCAKCKAC
missing_index = 0
missing_courses = ['Chemistry', 'Biological Engineering', 'Anthropology', 'Music and Theater Arts',
    'Comparative Media Studies']
for course in courses:
    f = util.dl_and_prep("http://web.mit.edu/urop/research/profiles/%s.html" % course)
    prof_info=re.findall("<dt><a href=\"(.*?)\"><strong>Prof\. (.*?)</strong></a>,.*?,.*?,.*?<.*?>(.*?)</a>\s*</dt>\s*<dd>(.*?)<", f)
    prof_info_alt= re.findall("<dt><strong><a href=\"(.*?)\">.*?\. (.*?)</a></strong>,.*?,.*?,.*?<.*?>(.*?)</a></dt>\s*<dd>(.*?)<",f)
    prof_info_alt2= re.findall("<dt><strong><a href=\"(.*?)\">.*?\. (.*?)</a>,</strong>.*?,.*?,.*?<.*?>(.*?)</a></dt>\s*<dd>(.*?)<",f)
    prof_info_alt3= re.findall("<dt><strong></strong><a href=\"(.*?)\">.*?\. (.*?)</a>,.*?,.*?,.*?<.*?>(.*?)</a></dt>\s*<dd>(.*?)<",f)
#    prof_info_alt4= re.findall("<dt><a href=\"(.*?)\"><strong>.*?\. (.*?)</strong></a>,.*?,.*?,.*?<.*?>(.*?)</a>\s*<strong>\(On Leave\)</strong></dt>\s*<dd>(.*?)<",f)
 #   prof_info_alt5= re.findall("<dt><strong><a href=\"(.*?)\">.*?\.(.*?)</a></strong>.*?,.*?,.*?<.*?>(.*?)</a>\s*<strong>\(On Leave\)</strong></dt>\s*<dd>(.*?)<",f)
    prof_info_alt6= re.findall("<dt><strong><a href=\"(.*?)\">.*?\. (.*?)</a></strong>,\s*.*?,\s*.*?,\s*.*?\s*<.*?>(.*?)</a></dt>\s*<dd>(.*?)<",f)
    department = re.findall("<title>MIT UROP: Current Research - (.*?):.*?</title>", f)
    if not department:
      department = [missing_courses[missing_index]]
      missing_index += 1
    course_profs = []
    print department
    for prof in prof_info:
        course_profs.append(prof)
    for prof in prof_info_alt:
        course_profs.append(prof)
    for prof in prof_info_alt2:
        course_profs.append(prof)
    for prof in prof_info_alt3:
        course_profs.append(prof)
#    for prof in prof_info_alt4:
#        course_profs.append(prof)
#    for prof in prof_info_alt5:
#        course_profs.append(prof)
    for prof in prof_info_alt6:
        course_profs.append(prof)
    mod_profs = []
    for prof in course_profs:
      prof = list(prof)
      prof.append(department[0])
      mod_profs.append(tuple(prof))

    all_prof_info += mod_profs 

prof_dictionary_list=[]
for prof in all_prof_info:
    if any('<' in p for p in prof):
      continue
    prof_dictionary={}
    prof_dictionary['name']=prof[1]
    prof_dictionary['personal_website']=prof[0]
    prof_dictionary['email']=prof[2]
    research = util.research_interest_extractor(prof[3])
    if research:
      prof_dictionary['keywords'] = research
    else:
      prof_dictionary['research_summary'] = prof[3]

    prof_dictionary['school'] = 'MIT'
    prof_dictionary['department'] = util.prep_department(prof[4])
    util.validate_professor(prof_dictionary)
    prof_dictionary_list.append(prof_dictionary)

pickle.dump(prof_dictionary_list, file('prof_dicts/mit.dat', 'w'))
