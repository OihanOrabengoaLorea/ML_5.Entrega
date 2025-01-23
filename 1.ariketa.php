<head>
    <style>
      
         th, tr, td{
            border: 1px solid black;
            width: 200px;
        row-gap: 0px;
     }
        
    </style>
</head>
<?php
$servername = "localhost:3306";
$username = "root";
$password = "1MG2024";
$dbname = "ML_8.Ataza";
 
//Konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

$row = "";

$postua="";
if (isset($_GET["postua"])) {
    $postua = $_GET["postua"];
}

$dortsala="";
if (isset($_GET["dortsala"])) {
    $dortsala = $_GET["dortsala"];
}

$izena="";
if (isset($_GET["izena"])) {
    $izena = $_GET["izena"];
}

//Konexioa konprobatu
if ($conn->connect_error) {
    die("Konexio Errorea" . $conn->connect_error);
} else {
    
}

?>
<table>
<tr>
    <th>Postua</th>
    <th>Dortsala</th>
    <th>Izena</th>
</tr>

</table>
<?php

$sql = "select postua, dortsala, izena from pilotoak";
$result = $conn->query(query: $sql);{
     //lerro bakoitzean dagoen data begiratzeko
 while ($row = $result->fetch_assoc()) {
    echo"<table>";
        echo "<tr><td>".$row["postua"]."</td>".
        "<td>". $row["dortsala"]."</td>".
        "<td>".$row["izena"]."</td>";
        echo"</table>";
}
}

?>