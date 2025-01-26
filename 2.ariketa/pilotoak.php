<?php
//db.php fitxategian dagoen datu basearen konexioa egiten da, kodea luzeegia ez izateko eta garbiagoa izateok
require_once("db.php");
 //Akzioa parametroak egiaztatzen du GET eskaera "pilotoa" den.
if ($_GET["akzioa"] == "pilotoa") {

//konexioaSortu metodoari deitzen diogu
    $conn = konexioaSortu();
    
    //select bat egiten da hemen, taulan informazio guztia ateratzeko, eta postua zutabea, gorantz ordenatuta egoteko
    $sql = "SELECT Postua, Dortsala, Izena FROM pilotoak order by Postua asc";
    //datu baseari eskaera
    $result = $conn->query($sql);
    //pilotoa izeneko array hutsa sortzen dugu
    $pilotoak = [];
    //eskaera egitean emaitak badaude, baldintza beteko da
    if ($result->num_rows > 0) {   
    //kontadore bat ezartzen dugu, zenbat datu gehitzen diren zenbatzeko 
        $kontadorea = 0;
        while ($row = $result->fetch_assoc()) {
    //ezarritako datuak, $pilotoak[$kontadorea] arrayean gordeko dira
            $pilotoak[$kontadorea] = ["Postua" => $row["Postua"], "Dortsala" => $row["Dortsala"], "Izena" => $row["Izena"]];
    //lerro bakoitza bukatzean, kontadoreak +1 egingo du
            $kontadorea ++;
        }
    //gehitutako errenkaden kopurua gordetzen da kopuruan.
        $pilotoak["kopurua"] = $kontadorea;
    //aurrekoa ez bada betetzen, kopuruan 0 balioa ezartzen da
    } else {
        $pilotoak["kopurua"] = 0;
    }
    //$pilotoak array osoa JSON formatuko testu bihurtzen da
    $bueltatutakoInformazioa = json_encode($pilotoak);
    //JSON formatuan bihurtutako datuak bidaltzen dira erantzun bezala. Honek AJAX eskaera jasotzen duen JavaScriptari informazioa eskuratzeko aukera ematen dio.
    echo $bueltatutakoInformazioa;
    die;
   
   
}
?>