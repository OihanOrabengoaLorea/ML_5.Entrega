<head>
    <style>
      
         th, tr, td{
            border: 1px solid black;
            width: 200px;
            row-gap: 0px;
            text-align: center;
            font-weight: bold;
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

//Konexioa konprobatu
if ($conn->connect_error) {
    die("Konexio Errorea" . $conn->connect_error);
} else {
    
}

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
    echo"<table class='klasifikazioa'>";
        echo "<tr><td>".$row["postua"]."</td>".
        "<td>". $row["dortsala"]."</td>".
        "<td>".$row["izena"]."</td>";
         echo"</table>";
   
}
echo"</div>";
}
?>
<form action="1.ariketa.php">
<button class="birkargatu">Taula birkargatu</button>
</form>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $(document).ready(function () {
        
        $(".birkargatu").on("click", function (e) {
            e.preventDefault;
             taulaBirkargatu();
        });
       

    });

    function taulaBirkargatu() {

        $.ajax({
            "url": "pilotoak.php",
            "method": "GET",
            "data": {
                "akzioa": "pilotoa",
            }
        })
            .done(function (bueltanDatorrenInformazioa) {

                var info = JSON.parse(bueltanDatorrenInformazioa);
                if (info.kopurua > 0) {
                    $(".klasifikazioa").html("");
                    for (var i = 0; i < info.kopurua; i++) {
                        $(".klasifikazioa").append("<td>" + info[i].postua + "</td>"+ "<td>"  + info[i].dortsala + "</td>"+"<td>" + info[i].izena + "</td>" "<br>");
                    }
                } else {
                    alert("Ez da elementurik kargatu");
                }

            })
            .fail(function (e) {
                e.preventDefault;
                alert("Klasifikazioa ezin da aktualizatu errore batengatik");
            })
            .always(function () {
                // alert("aa");
            });
    }
</script>

