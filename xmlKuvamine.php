<?php
$opilased=simplexml_load_file("opilased.xml");
?>
<!DOCTYPE html>
<html>
<head>
<title>XML faili kuvamine - opilased.xml</title>
</head>
<body>
<h1>XML faili kuvamine - opilased.xml</h1>

<?php
//õilase nimi
echo "1. õpilase nimi: ".$opilased->opilane[0]->nimi;
echo "2. õpilase nimi: ".$opilased->opilane[1]->nimi;
echo "3. õpilase nimi: ".$opilased->opilane[2]->nimi;
echo "4. õpilase nimi: ".$opilased->opilane[3]->nimi;
echo "5. õpilase nimi: ".$opilased->opilane[4]->nimi;
?>
</body>
</html>