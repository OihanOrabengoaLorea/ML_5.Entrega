<?php
//konexioa sortu metodoa sortzen dugu 
function konexioaSortu()
{
    //datu basearen zerbitzari izena 
    $servername = "localhost";
    //datu basearen erabiltzaile izena
    $username = "root";
    //pasahitza
    $password = "1MG2024";
    //taularen izena
    $dbname = "ml_8.ataza";
   //datu basearen konexioa
    $conn = new mysqli($servername, $username, $password, $dbname);
   //errorea gertatzen bada, hurrengo mezua inprimatuko da
    if ($conn->connect_error) {
        die("Konexioan hurrengo errorea gertatu da: " . $conn->connect_error);
    }
 
    return $conn;
}
?>