import urllib2
import re
import os.path
import hashlib
def dl_and_prep(url):

  cache_loc = 'cache/' + hashlib.md5(url).hexdigest()
  if os.path.exists(cache_loc):
    stream = file(cache_loc)
  else:
    user_agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7"
    headers = {}
    headers["User-Agent"] = user_agent
    url_request = urllib2.Request(url,None,headers)
    #try:
    file(cache_loc, 'w').write(urllib2.urlopen(url_request).read())
    #except IOError as ex:
     # os.remove(cache_loc)
     # raise Exception('Download failure.')
    return dl_and_prep(url)
  doc = stream.read().replace('\r\n', '')
  if doc == '':
    os.remove(cache_loc)
    return dl_and_prep(url)
  
  
  return re.sub('>(\s*?)<', '><', doc)

def remove_tags(string):
  return re.sub('<\w*?>', '', string)

def research_interest_extractor(research_string):
  #first, is it a long summary or short blurb?
  #signals: 
  # Shorter than 300 characters, comma word / ratio?
  if len(research_string) < 300:
    interests1 = research_string.split(',')
    interests2 = research_string.split(';')

def split_and_clean(words):
  return [w.strip() for w in words.lower().split(',')]



ex1 = """Scheduling, planning, optimization, multi-agent systems, manufacturing, machine learning,
intelligent transportation, human-computer interaction, factory and warehouse automation,
distributed problem solving, constraint-directed reasoning, artificial intelligence"""
ex2 = """Data structures, graph algorithms, on-line algorithms, parsing natural languages"""
ex3 = """Director, Mobile Commerce Lab; Director, e-Supply Chain Management Lab; Co-Director, COS
PhD Program; Co-Director, MBA Track in Technology Leadership; Other research areas: Web Commerce,
Security and Privacy, AI and HCI."""
ex4 = """Artificial intelligence; electronic commerce; game theory; multiagent systems; auctions and
exchanges; automated negotiation and contracting; coalition formation; safe exchange; normative
models of bounded rationality; resource-bounded reasoning; constraint satisfaction; machine
learning; networks; combinatorial optimization"""
