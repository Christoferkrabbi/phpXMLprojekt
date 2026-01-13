<?php
$opilased=simplexml_load_file("opilased.xml");
$feed=simplexml_load_file("https://www.err.ee/rss");
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
<h1>RSS uudiste lugemine</h1>
<?php
echo "<ul>";
foreach($feed->channel->item as $item){
    echo "<li><a href='$item->link' target='_blank'>".$item->title."</a>";
    echo "<br>".$item->description."<br>"."Kuupäev:".$item->pubDate.
        "</li>";

}
echo "</ul>"
?>

</body>
</html>