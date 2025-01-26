<?php
//db.php fitxategian dagoen datu basearen konexioa egiten da, kodea luzeegia ez izateko eta garbiagoa izateok
require_once("db.php");

//konexioaSortu metodoari deitzen diogu
$conn = konexioaSortu();

//select bat egiten da hemen, taulan informazio guztia ateratzeko, eta postua zutabea, gorantz ordenatuta egoteko
$sql = "SELECT Postua, Dortsala, Izena FROM pilotoak order by Postua asc";

$result = $conn->query($sql);

//titulu bat taularen aurretik ateratzeko
echo "<h3>Pilotoen zerrenda:</h3>";
//datu baseari eskaera
if ($result->num_rows > 0) {
//taularen estiloak
    echo "<table border='1' class='taula'>";
    ?>
    <!--taularen lehenengo lerroa-->
    <tr><th>Postua</th><th>Dortsala</th><th>Izena</th></tr>
    <?php
    //taulan datuak badaude, taula guztia inprimatuko du
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Postua"] . "</td>";
        echo "<td>" . $row["Dortsala"] . "</td>";
        echo "<td>" . $row["Izena"] . " </td>";
        echo "</tr>";
    }
    echo "</table>";
//ez badago daturik, iruzkin hau aterako da
} else {
    echo "Ez dago daturik taulan.";
}
//konexio itxiera
$conn->close();
?>
<br>
<!--web orria birkargatzeko botoia, baina ez du egiten, zeren, click egiteko funtzioa komentario gisa ezarri dugu-->
<button class="birkargatu">Birgarkatu</button>

 
<body>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
 
    <script>
        $(document).ready(function () {
            // $(".birkargatu").on("click", function () {
            //     taulaBirkargatu();
            // });
            //web orria segunduro birkargatuko da
            setInterval(taulaBirkargatu, 1000);
        });
        //taula birkargatu funtzioa sortzen dugu
        function taulaBirkargatu() {
 
            $.ajax({
                //Zerbitzariari eskaera bat bidaltzen zaio  
                "url": "pilotoak.php",
                //Datuak hartzeko get metodoa erabiltzen dugu
                "method": "GET",
                "data": {
                //Zerbitzariari akzioa izeneko parametro bat bidaltzen zaio, pilotoa balioarekin
                    "akzioa": "pilotoa",
                }
            })
                // jQuery AJAX eskaera arrakastatsua izan denean exekutatzen den funtzioa da. Zerbitzariak bidalitako erantzuna kudeatzen du.
                //Eskaeraren erantzuna parametro bezala jasotzen duen funtzio bat definitzen da.
                .done(function (bueltatutakoInformazioa) {
                //JSON formatuan bihurtutako datuak, datuak aldagaian gordetzen dira
                    var datuak = JSON.parse(bueltatutakoInformazioa);
                //Zerbitzaritik jasotako datuen kopurua adierazten du.
                    if (datuak.kopurua > 0) {
                        //Elementu horren barruan dagoen HTML edukia guztiz garbitzen du
                        $(".taula").html("");
                        //Taularen goiburuak sortzen dira
                        $(".taula").html("<th>Postua</th><th>Dortsala</th><th>Izena</th>");
                        //datuak.kopurua aldagaiaren balioa erabiliz iterazio bat hasten da, datuen kopuruaren arabera.
                        for (var i = 0; i < datuak.kopurua; i++) {
                            $(".taula").append(
                                "<tr>" +
                                //: Iterazioan dagoen datuaren informazioa eskuratzen du
                                "<td>" + datuak[i].Postua + "</td>" +
                                "<td>" + datuak[i].Dortsala + "</td>" +
                                "<td>" + datuak[i].Izena + "</td>" +
                                "</tr>"
                            );
                        }
                    } else {
                       // balioa 0 bada, alerta iruzkin hau agertuko zaigu
                        alert("Ez da elementurik kargatu");
                    }
                })
 
        }
 
    </script>
 
</body>
 
</html>