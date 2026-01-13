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
//kõik õpilased
?>
<table>
    <tr>
        <th>Õpilase nimi</th>
        <th>Isikukood</th>
        <th>Eriala</th>
        <th>Elukoht</th>
    </tr>
    <?php
    foreach($opilased->opilane as $opilane){
        echo "<tr>";
        echo "<td>".$opilane->nimi."</td>";
        echo "<td>".$opilane->isikukood."</td>";
        echo "<td>".$opilane->eriala."</td>";
        echo "<td>".$opilane->elukoht->linn."
<".$opilane-> elukoht->maakond."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>