<?php
require ('funktsioonid.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>XML faili kuvamine funktsioonide abil</title>
</head>
<body>
<h1>XML faili kuvamine - opilased.xml</h1>
<?php
uudised('https://ww.err.ee/rss', 5)
?>

<h1>postimees RSS</h1>
<?php
uudised('https://ww.postimees.ee/rss', 5)
?>
</body>
</html>