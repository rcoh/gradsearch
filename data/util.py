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
  return re.sub('<.*?>', '', string)

def research_interest_extractor(research_string):
  #first, is it a long summary or short blurb?
  #if they have :s, ","s or ;, give up
  score = 0
  if all([':' in research_string, ',' in research_string, ';' in research_string]):
    return None

  if len(research_string) > 300:
    score -= 5 
  
  research_string = research_string.replace('.', ',')
  split_on_semi = split_and_clean(research_string, ';')
  split_on_commas = split_and_clean(research_string, ',')
  split_on_both = split_list(split_on_semi, ',')
  results = [split_on_semi, split_on_commas, split_on_both]
  scores = [score_splitting(s) for s in results]

  if max(scores) < -4:
    return None

  return clean_results(results[scores.index(max(scores))])


def score_splitting(split):
  score = 0
  for word in split:
    if len(word) > 40:
      score -= (len(word) - 40) / 3 
    else:
      score += .5
  return score

def split_list(words, delim):
  ret = []
  for w in words:
    ret += w.split(delim)
  return ret

def clean_results(split):
  ret = []
  for word in split:
    word = word.strip()
    if word.startswith('and'):
      ret.append(word.replace('and', '', 1))
    elif word != '' and len(word) > 4:
      ret.append(word)
  return ret

def html_escape(content):
  content = content.replace('\x92', '&#146;')
  content = content.replace('\x93', '&#147;')
  content = content.replace('\x94', '&#148;')
  return content

def split_and_clean(words, delim):
  words = words.replace('\n', ' ')
  split = [w.strip() for w in words.lower().split(delim)]
  return clean_results(split)

if __name__ == "__main__":
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
  ex5 = """Research in the design and control of mechatronic systems, e.g., systems which incorporate
  electromechanical actuators, sensors, mechanical design, system dynamics, and precision measurement
  machines."""
  ex6 = """Micro electro-mechanical systems (MEMS), micro-/nanotechnologies for electronics cooling,
  energy conversion, water desalination, and biotechnologies."""
  ex7 = """Research projects focus on water in environmental planning, policy, and landscape design in
  the U.S. and South Asia. Disaster-resilient design; human dimensions of climate change in complex
  river basins. Landscape and garden history and heritage conservation in South Asia."""

  print research_interest_extractor(ex1)
  print research_interest_extractor(ex2)
  print research_interest_extractor(ex3)
  print research_interest_extractor(ex4)
  print research_interest_extractor(ex5)
  print research_interest_extractor(ex6)
  print research_interest_extractor(ex7)
