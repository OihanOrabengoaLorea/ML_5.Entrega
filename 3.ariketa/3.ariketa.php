<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form action="3.Ariketa.php" method="POST">
    <!--eskualdeen option value bat sortzen dugu, hiru eskualde desberdin aukeratzeko-->
        <label for="eskualdea"><b>Eskualdeak</b></label>
        <select id="eskualdea" name="eskualdea">
            <!--lehenengo option value-a ezin izango da aukeratu, disabled selected ezarri dugulako-->
            <option value="" disabled selected></option>
            <!--hemen hiru eskualdeak ezarri dutugu, aukera moduan hautatzeko-->
            <option value="Goierri">
                Goierri
            </option>
            <option value="Urola">
                Urola
            </option>
            <option value="Buruntzaldea">
                Buruntzaldea
            </option>
        </select>
    <!--hemen herriak definitu dugu, JS-ko funtzio batean ezartzeko eta aukerak bertan ezartzeko-->
        <label for="herriak"><b>Herriak</b></label>
        <select id="herriak" name="herriak"></select>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function () {
        //orria segunduro birkargatzeko balio du
            setInterval(eskualdekoHerriak, 1000);
        });
        //funtzio bat sortzen dugu
        function eskualdekoHerriak() {
            
            $.ajax({
                //Zerbitzariari eskaera bat bidaltzen zaio  
                "url": "3.Ariketa.php",
                //Datuak bidaltzeko post metodoa erabiltzen dugu
                "method": "POST",
                "data": {
                //Zerbitzariari akzioa izeneko parametro bat bidaltzen zaio, eskualdekoHerriak balioarekin
                    "akzioa": "eskualdekoHerriak",

                }
            })

        //herriak izeneko konstante bat definitzen dugu
            const herriak = [
        //Hemen objektuen array bat sortzen dugu eta array bakoitza eskualde bat ordezkatuko du.
                { eskualdea: 'Goierri', herriak: ['Beasain', 'Ordizia', 'Legazpi', 'Lazkao'] },
                { eskualdea: 'Urola', herriak: ['Urretxu', 'Azpeitia', 'Azkoitia', 'Zumarraga'] },
                { eskualdea: 'Buruntzaldea', herriak: ['Andoain', 'Hernani', 'Astigarraga', 'Usurbil'] }
            ];
        //getElementById HTML dokumentuan id="eskualdea" duten elementua bilatuko du.
        //.value-k hautatutako balioa eskuratzen du
            const eskualdea = document.getElementById('eskualdea').value;
        //getElementById goiko berdina izango litzateke baina kasu honetan herriekin
            const herriaSelect = document.getElementById('herriak');
        //aukera zerrenda guztiz garbitzen du, zerrendan aurretik zeuden aukerak ezabatuz
            herriaSelect.innerHTML = '';


            if (eskualdea) {

                //eskualdekoHerria arraya definitzen da
                //herriak arrayean bilaketa egiten da
                //find funtzioaren irizpidea eskualdea aldagaiaren balioa bat etortzen duen lehenengo objektua bilatzea da, 
                //herria.eskualdea atributua erabiliz. Hau lortuta, objektu hori gordetzen da eskualdekoHerria aldagaian.
                const eskualdekoHerria = herriak.find(herria => herria.eskualdea === eskualdea);
                // arrayaren elementu bakoitzarentzat iterazio bat egiten da. Elementu bakoitza herriak izeneko aldagai batean gordetzen da.
                eskualdekoHerria.herriak.forEach(herriak => {
                // HTML dokumentuan <option> elementu berri bat sortzen da, select kutxa batean erabiltzeko.
                    const option = document.createElement('option');
                //Sortutako <option> elementuaren value atributua ezartzen da. Balio hau herriak aldagaian gordetako elementua da
                    option.value = herriak;
                //Sortutako <option> elementuaren testua ezartzen da, select kutxan ikusiko den aukera. Hemen ere herriak balioa erabiltzen da.
                    option.text = herriak;
                //Aurretik definitutako herriaSelect elementuari sortutako <option> elementua gehitzen zaio.
                    herriaSelect.append(option);
                });
            }
        }

    </script>
</body>

</html>