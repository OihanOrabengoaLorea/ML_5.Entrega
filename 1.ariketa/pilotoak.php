<?php
$servername = "localhost:3306";
$username = "root";
$password = "1MG2024";
$dbname = "ML_8.Ataza";
 
//Konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

//Konexioa konprobatu
if ($conn->connect_error) {
    die("Konexio Errorea" . $conn->connect_error);
} else {
    
}


if ($_GET["akzioa"] == "lortuPilotoa") {

    $conn = konexioaSortu();

    $sql = "SELECT * FROM pilotoak";
    $result = $conn->query($sql);
    $pilotoak = [];

    if ($result->num_rows > 0) {
        $kontadorea = 0;
        while ($row = $result->fetch_assoc()) {
            $pilotoak[$kontadorea] = ["postua" => $row["postua"], "dortsala" => $row["dortsala"], "izena"=> $row["izena"]];
            $kontadorea++;
        }
        
       

        $pilotoak["kopurua"] = $kontadorea;
       
        ;

    } else {
        $pilotoak["kopurua"] = 0;
    }
        $bueltanDatorrenInformazioa=json_encode($pilotoak);
        echo $bueltanDatorrenInformazioa;
        die;
    }



