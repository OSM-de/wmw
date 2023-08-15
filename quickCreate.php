<?php

echo "Quick Create resources and features for users\n";

$u = readline("Username: ");
$d = readline("Area (Enter = europe/germany): ");
if ($d == "") $d = "europe/germany";
$c = readline("Usercode (Enter = de): ");
if ($c == "") $c = "de";

echo "Input the GeoJSON\n";

$fp = fopen("php://stdin","r");
$gj = ""; 

while ($f = fgets($fp,65535)) {
    if (trim($f) == "") break;
    $gj .= $f;
}

// create feature
file_put_contents("features/" . $d . "/" . $c . "-" . $u . ".geojson", $gj);

// create resource
$r = <<<EOF
{
    "id": "$c-$u",
    "type": "osm",
    "locationSet": {"include": ["$c-$u.geojson"]},
    "languageCodes": ["de", "en"],
    "strings": {
      "name": "$u on osm.org",
      "description": "OpenStreetMap Profile for $u",
      "url": "https://osm.org/user/$u"
    }
  }
EOF;
file_put_contents("resources/" . $d . "/" . $c . "-" . $u . ".json", $r);

?>