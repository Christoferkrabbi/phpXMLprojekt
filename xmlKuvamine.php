<?php

$opilased = simplexml_load_file("opilased.xml");

function LisaOpilane()
{
    $xmlDoc = new DOMDocument("1.0", "UTF-8");
    $xmlDoc->preserveWhiteSpace = false;
    $xmlDoc->load("opilased.xml");
    $xmlDoc->formatOutput = true;

    $xmlRoot = $xmlDoc->documentElement;
    $xmlOpilane = $xmlDoc->createElement("opilane");
    $xmlRoot->appendChild($xmlOpilane);

    // basic info
    $xmlOpilane->appendChild($xmlDoc->createElement("nimi", $_POST["nimi"]));
    $xmlOpilane->appendChild($xmlDoc->createElement("isikukood", $_POST["isikukood"]));
    $xmlOpilane->appendChild($xmlDoc->createElement("eriala", $_POST["eriala"]));
    $failinimi = $_FILES["pilt"]["name"];
    $ajutine = $_FILES["pilt"]["tmp_name"];

    move_uploaded_file($ajutine, "pildid/".$failinimi);

    $xmlOpilane->appendChild(
            $xmlDoc->createElement("pilt", $failinimi)
    );

    $elukoht = $xmlDoc->createElement("elukoht");
    $elukoht->appendChild($xmlDoc->createElement("linn", $_POST["linn"]));
    $elukoht->appendChild($xmlDoc->createElement("maakond", $_POST["maakond"]));
    $xmlOpilane->appendChild($elukoht);

    $aine1 = $xmlDoc->createElement("aine");
    $aine1->appendChild($xmlDoc->createElement("nimetus", $_POST["aine1"]));
    $aine1->appendChild($xmlDoc->createElement("hinne", $_POST["hinne1"]));
    $xmlOpilane->appendChild($aine1);

    $aine2 = $xmlDoc->createElement("aine");
    $aine2->appendChild($xmlDoc->createElement("nimetus", $_POST["aine2"]));
    $aine2->appendChild($xmlDoc->createElement("hinne", $_POST["hinne2"]));
    $xmlOpilane->appendChild($aine2);

    $xmlDoc->save("opilased.xml");
}

function erialaOtsing($paring){
    global $opilased;
    $tulemus = array();

    foreach($opilased->opilane as $opilane){

        if (
                stripos($opilane->nimi, $paring) === 0 ||
                stripos($opilane->eriala, $paring) === 0 ||
                stripos($opilane->isikukood, $paring) === 0
        ){
            if(!in_array($opilane, $tulemus)){
                $tulemus[] = $opilane;
            }
        }

        foreach($opilane->aine as $aine){
            if(stripos($aine->nimetus, $paring) === 0){
                if(!in_array($opilane, $tulemus)){
                    $tulemus[] = $opilane;
                }
            }
        }
    }

    return $tulemus;
}

function keskmineHinne($opilane){
    $sum = 0;
    $count = 0;

    foreach($opilane->aine as $aine){
        $sum += (int)$aine->hinne;
        $count++;
    }

    return $count > 0 ? round($sum/$count,2) : 0;
}

if(isset($_POST["submit"])){
    LisaOpilane();
    header("Location: ".$_SERVER["PHP_SELF"]);
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Õpilased XML</title>
    <link rel="stylesheet" href="tableStyle.css">
</head>

<body>

<h1>Õpilased</h1>

<!-- SEARCH -->
<form method="post">
    <input type="text" name="otsing" placeholder="Nimi | Eriala | Isikukood | Aine">
    <input type="submit" value="Otsi">
</form>


<?php

if(!empty($_POST["otsing"])){
    $students = erialaOtsing($_POST["otsing"]);
}
else{
    $students = $opilased->opilane;
}

echo "<table>
<tr>
<th>Nimi</th>
<th>Isikukood</th>
<th>Eriala</th>
<th>Elukoht</th>
<th>Pilt</th>
<th>Õppeained</th>
<th>Keskmine hinne</th>
</tr>";

foreach($students as $opilane){

    echo "<tr>";

    echo "<td>$opilane->nimi</td>";
    echo "<td>$opilane->isikukood</td>";
    echo "<td>$opilane->eriala</td>";

    echo "<td>".$opilane->elukoht->linn.", ".$opilane->elukoht->maakond."</td>";

    echo "<td><img src='pildid/$opilane->pilt' width='80'></td>";

    echo "<td>";
    foreach($opilane->aine as $aine){
        echo $aine->nimetus." - ".$aine->hinne."<br>";
    }
    echo "</td>";

    echo "<td>".keskmineHinne($opilane)."</td>";

    echo "</tr>";
}

echo "</table>";

?>

<h2>Lisa uus õpilane</h2>

<form method="post" enctype="multipart/form-data">
    <table>

        <tr>
            <td>Nimi</td>
            <td><input type="text" name="nimi" required></td>
        </tr>

        <tr>
            <td>Eriala</td>
            <td><input type="text" name="eriala" required></td>
        </tr>

        <tr>
            <td>Isikukood</td>
            <td><input type="text" name="isikukood" required></td>
        </tr>

        <tr>
            <td>Linn</td>
            <td><input type="text" name="linn" required></td>
        </tr>

        <tr>
            <td>Maakond</td>
            <td><input type="text" name="maakond" required></td>
        </tr>

        <tr>
            <td>Pildi fail</td>
            <td><input type="file" name="pilt"></td>
        </tr>

        <tr>
            <td>Aine 1</td>
            <td><input type="text" name="aine1" required></td>
        </tr>

        <tr>
            <td>Hinne 1</td>
            <td><input type="number" min="1" max="5" name="hinne1" required></td>
        </tr>

        <tr>
            <td>Aine 2</td>
            <td><input type="text" name="aine2" required></td>
        </tr>

        <tr>
            <td>Hinne 2</td>
            <td><input type="number" min="1" max="5" name="hinne2" required></td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Lisa õpilane">
            </td>
        </tr>

    </table>
</form>

</body>
</html>
