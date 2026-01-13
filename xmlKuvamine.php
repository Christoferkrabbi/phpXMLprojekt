<?php
$opilased=simplexml_load_file("opilased.xml");
//õilase otsing
function erialaOtsing($paring){
    global $opilased;
    $otsing = $_POST['otsing'];
    foreach($opilased->opilane as $opilane) {
        if (substr(strtolower($opilased->eriala), 0, strlen($paring))
            == strtolower($paring)){
            array_push($tulemus, $opilane);
        }
    }
        return $tulemus;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>XML faili kuvamine - opilased.xml</title>
</head>
<body>
<h1>XML faili kuvamine - opilased.xml</h1>

<form action ="?" method="post">
    <label for="otsing">Otsi õpilast eriala järgi:</label>
    <input type="text" name="otsing" placeholder="otsi">
    <input type="submit" value="Otsi">
</form>
<?php
//otsingu tulemus
if(!empty($_POST['otsing'])) {
    $tulemus = erialaOtsing($_POST['otsing']);
    foreach ($tulemus as $opilane) {
        echo $opilane->nimi . " - " . $opilane->eriala . "<br>";
    }
}
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
<h1>RSS uudiste lugemine</h1>
<?php
/*
echo "<ul>";
foreach($feed->channel->item as $item){
    echo "<li><a href='$item->link' target='_blank'>".$item->title."</a>";
    echo "<br>".$item->description."<br>"."Kuupäev:".$item->pubDate.
        "</li>";

}
echo "</ul>"*/
?>

</body>
</html>