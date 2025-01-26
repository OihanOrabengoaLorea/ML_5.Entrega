<?php 
// db.php fitxategian dagoen datu basearen konexioa egiten da, kodea luzeegia ez izateko eta garbiagoa izateko
require_once("db.php");

// konexioaSortu metodoari deitzen diogu
$conn = konexioaSortu();

// select bat egiten da hemen, taulan informazio guztia ateratzeko, eta postua zutabea, gorantz ordenatuta egoteko
$sql = "SELECT Postua, Dortsala, Izena FROM pilotoak ORDER BY Postua ASC";

$result = $conn->query($sql);

// titulu bat taularen aurretik ateratzeko
echo "<h3>Pilotoen zerrenda:</h3>";
// datu baseari eskaera
if ($result->num_rows > 0) {
    // taularen estiloak
    echo "<table border='1' class='taula'>";
    ?>
    <!--taularen lehenengo lerroa-->
    <tr><th>Postua</th><th>Dortsala</th><th>Izena</th></tr>
    <?php
    // taulan datuak badaude, taula guztia inprimatuko du
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Postua"] . "</td>";
        echo "<td>" . $row["Dortsala"] . "</td>";
        echo "<td>" . $row["Izena"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
// ez badago daturik, iruzkin hau aterako da
} else {
    echo "ez dago daturik taulan.";
}
// konexio itxiera
$conn->close();
?>
<br>
<!--web orria birkargatzeko botoia-->
<button class="birkargatu">Birkargatu</button>

<body>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
 
    <script>
        $(document).ready(function () {
            let previousData = []; // aurreko taulako datuak gordetzeko

            // botoiari click event-a gehitzen zaio, taula birkargatzeko
            $(".birkargatu").on("click", function () {
                actualizarTabla(); // taula berriz kargatzeko funtzioari deia egiten zaio
            });

            // taula birkargatzeko funtzioa
            function actualizarTabla() {
                $.ajax({
                    url: "pilotoak.php", // zerbitzariaren datuak kargatzen dituen fitxategia
                    method: "GET", // datuak GET metodoaren bidez eskatzen dira
                    data: { akzioa: "pilotoa" }, // zerbitzariari parametro bat bidaltzen zaio (akzioa: pilotoa)
                })
                .done(function (response) {
                    // zerbitzariak bueltatzen duen JSON formatuan dagoen erantzuna
                    const data = JSON.parse(response);

                    if (data.kopurua > 0) {
                        // taula garbitzen da
                        $(".taula").html(""); 
                        // taularen goiburua gehitzen da
                        $(".taula").html("<tr><th>Postua</th><th>Dortsala</th><th>Izena</th></tr>");

                        // datu berriak iteratzen dira
                        for (let i = 0; i < data.kopurua; i++) {
                            const currentRow = data[i];
                            let rowStyle = "";

                            // aurreko datuak lehenengo datuekin konparatzen dira
                            const previousRow = previousData.find(item => item.Dortsala === currentRow.Dortsala);
                            // aldaketak taulan eta lineetan egiten dira
                            if (previousRow) {
                                if (previousRow.Postua > currentRow.Postua) {
                                    rowStyle = "background-color: #d4edda; color: #155724;"; // posizioa hobetu du (berdea)
                                } else if (previousRow.Postua < currentRow.Postua) {
                                    rowStyle = "background-color: #f8d7da; color: #721c24;"; // posizioa okertu du (gorria)
                                }
                            }

                            // fila bat gehitzen da eta, posizioaren aldaketaren arabera, kolore bat ematen zaio
                            $(".taula").append(
                                `<tr style="${rowStyle}">
                                    <td>${currentRow.Postua}</td>
                                    <td>${currentRow.Dortsala}</td>
                                    <td>${currentRow.Izena}</td>
                                </tr>`
                            );
                        }

                        // aurreko datuak eguneratzen dira, hurrengo konparazioetarako
                        previousData = [...data];
                    } else {
                        // daturik ez badago, alerta bat erakusten da
                        alert("ez da elementurik kargatu");
                    }
                });
            }
        });
    </script>
</body>
</html>
