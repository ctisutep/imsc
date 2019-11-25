import json
def parse_c(c):
	just_c = c[9:-2]
	without_commas = just_c.split(',')
	parsed = []
	for i in range(len(without_commas)):
		xy = without_commas[i].split(' ')
		to_send = xy[0] + "," + xy [1] + ",0\n"	
		parsed.append(to_send)
	return parsed

soil_name = "Plasticity Index"
soil_val = "pi_r"
filename = "./../jsons/all_pi_36.json"
with open(filename, 'r') as f:
	data = json.load(f)

kml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?> \
<kml xmlns=\"http://www.opengis.net/kml/2.2\">\
<Document>\
<name>ctis_isc_polygon.kml</name>\
<Style id=\"thickLine\"><LineStyle><width>2.5</width></LineStyle></Style>\
<Style id=\"transparent50Poly\"><PolyStyle><color>7fffffff</color></PolyStyle></Style>"

for i in range(len(data)):
	print("Working on outer loop. " + str(i) + " of " + str(len(data)))
	value = str(data[i][soil_val])
	kml += "<Placemark>\
	<name>hollow polygon " + str(i) + " </name>\
	<ExtendedData>\
	<Data name=\"" + soil_name + "\">\
	<value>" + value + "</value>\
	</Data>\
	</ExtendedData>\
	<Polygon>\
	<outerBoundaryIs>\
	<LinearRing>\
	<coordinates>"
	parsed = parse_c(data[i]["POLYGON"])
	for j in range(len(parsed)):
		print("Working on outer loop. " + str(i) + " of " + str(len(data)))
		print("Working on inner loop. " + str(j) + " of " + str(len(parsed)))
		kml += parsed[j]
	kml += "</coordinates>\
	</LinearRing>\
	</outerBoundaryIs>\
	</Polygon>\
	<styleUrl>#transparent50Poly</styleUrl>\
	</Placemark>"
	print("Working on outer loop. " + str(i) + " of " + str(len(data)))

kml += "</Document></kml>"

file_kml = open('ctis_isc_polygon_all_pi_36_inches.kml', 'w+')
file_kml.write(kml)