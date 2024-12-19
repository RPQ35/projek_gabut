<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$conne = new mysqli("localhost", "root", "", "undangan1");

// Check connection
if ($conne->connect_error) {
    die("Connection failed: " . $conne->connect_error);
}

$SQL = "SELECT * FROM datanya WHERE object_name='cover'";
$hasil = $conne->query($SQL)->fetch_assoc();

if (!$hasil) {
    die("Query failed: " . $conne->error);
}

$nama=$hasil['nama'];
$obj=$hasil['object_name'];
$imageData = 'data:image/jpeg;base64,' . base64_encode($hasil['foto']);

// $imageData = ''; // Variable to hold the background image data
// $imageData = 'data:image/jpeg;base64,' . base64_encode($baris['foto']); // Assuming 'foto1' is the BLOB column




?>

<main style="background-image: url('<?php echo $imageData; ?>');" id="cover">


<div class="nama_cover" style="display:flex;">
    <?php
       $text = $nama; 

       $words = explode(" ", $text); // Splits the string at each space -->
       
echo "<h2>$words[0]</h2>"; 
echo "<h2>$words[1]</h2>"; 
echo "<h2>$words[2]</h2>";
?>
</div>
<button class="bukaan">open</button>
    
</main>



<?php $conne->close();?>
</body>
</html>