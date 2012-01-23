import json
import pickle
def run():
  profs = json.load(file('csail_json.js'))['items']
  output = []
  for p in profs:
    pd = {}
    pd['name'] = p['label']
    pd['email'] = p['email']
#    pd['keywords'] = extract_keywords(p['group'])
#    if not isinstance(pd['keywords']):
#      pd['keywords'] = list(pd['keywords'])

    pd['image'] = p['photo']
    output.append(pd)
  pickle.dump(output, file('prof_dicts/csailjson.dat', 'w'))

def extract_keywords(group):
  if isinstance(group, list):
    return [extract_keywords(g) for g in group]
  else:
    return cleanup(group.replace('group', ''))

def cleanup(s):
  return s.strip().lower()

if __name__ == "__main__":
  run()

