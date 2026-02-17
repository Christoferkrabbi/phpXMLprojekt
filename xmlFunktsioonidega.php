<?php
require ('funktsioonid.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>XML faili kuvamine funktsioonide abil</title>
</head>
<body>
<h1>RSS uudised</h1>
<?php
uudised('https://www.err.ee/rss', 5)
?>
<h1>Postimees RSS uudised</h1>
<?php
uudised('http://www.postimees.ee/rss', 3)
?>
</body>
</html>