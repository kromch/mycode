#!/usr/bin/env python

results = []
with open("data.csv", "r") as file:
    for ln in file:
        if len(ln) and ln.find("country")==-1:
            buf = ln.split(",")
            buf = list(map(str.strip, buf))
            for i in range(len(buf)):
                try:
                    p = list(''.join(rs.keys()).upper() for rs in results).index(buf[0].upper())
                    if i>0:
                        for k in results[p].keys():
                            results[p][k]["people"].append(buf[i])
                            results[p][k]["count"] = len(results[p][k]["people"])
                except:
                    results.append({buf[0]:dict(people=[], count=0)})
print('{')
for i in range(len(results)):
    txt = '   {0} : \n             {1}'
    print(txt.format(''.join(results[i].keys()), results[i][''.join(results[i].keys())]))
print('}')