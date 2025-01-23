<?php
require_once("db.php");
 
$conn = konexioaSortu();
 
$sql = "SELECT Postua, Dortsala, Izena FROM pilotoak order by Postua asc";
$result = $conn->query($sql);
 
echo "<h3>Pilotoen zerrenda:</h3>";
if ($result->num_rows > 0) {
    echo "<table border='1' class='taula'>";
    echo "<tr><th>Postua</th><th>Dortsala</th><th>Izena</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Postua"] . "</td>";
        echo "<td>" . $row["Dortsala"] . "</td>";
        echo "<td>" . $row["Izena"] . " </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Ez dago daturik taulan.";
}
$conn->close();
?>
<br>
<button class="birkargatu">Birgarkatu</button>

 
<body>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
 
    <script>
        $(document).ready(function () {
            // $(".birkargatu").on("click", function () {
            //     taulaBirkargatu();
            // });
            setInterval(taulaBirkargatu, 1000);
        });
 
        function taulaBirkargatu() {
 
            $.ajax({
                "url": "pilotoak.php",
                "method": "GET",
                "data": {
                    "akzioa": "pilotoa",
                }
            })
 
                .done(function (bueltatutakoInformazioa) {
 
                    var datuak = JSON.parse(bueltatutakoInformazioa);
                    if (datuak.kopurua > 0) {
                        $(".taula").html("");
                        $(".taula").html("<th>Postua</th><th>Dortsala</th><th>Izena</th>");
                        for (var i = 0; i < datuak.kopurua; i++) {
                            $(".taula").append(
                                "<tr>" +
                                "<td>" + datuak[i].Postua + "</td>" +
                                "<td>" + datuak[i].Dortsala + "</td>" +
                                "<td>" + datuak[i].Izena + "</td>" +
                                "</tr>"
                            );
                        }
                    } else {
                        alert("Ez da elementurik kargatu");
                    }
                })
                .fail(function () {
                   
                })
 
        }
 
    </script>
 
</body>
 
</html>