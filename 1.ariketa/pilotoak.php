<?php
require_once("db.php");
 
if ($_GET["akzioa"] == "pilotoa") {
    $conn = konexioaSortu();
 
    $sql = "SELECT Postua, Dortsala, Izena FROM pilotoak order by Postua asc";
    $result = $conn->query($sql);
    $pilotoak = [];
 
    if ($result->num_rows > 0) {    
        $kontadorea = 0;
        while ($row = $result->fetch_assoc()) {
            $pilotoak[$kontadorea] = ["Postua" => $row["Postua"], "Dortsala" => $row["Dortsala"], "Izena" => $row["Izena"]];
            $kontadorea ++;
        }
        $pilotoak["kopurua"] = $kontadorea;
       
    } else {
        $pilotoak["kopurua"] = 0;
    }
 
    $bueltatutakoInformazioa = json_encode($pilotoak);
    echo $bueltatutakoInformazioa;
    die;
   
   
}
?>