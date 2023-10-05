<?php

session_start();
$latitude = $_SESSION['lat'];
$longitude = $_SESSION['lon'];
$ent = json_encode($_SESSION['entreprises']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/particulier.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Jw27k5C8i5eDvotT+L/CqU5Fb4f7d92k0Gzj5BB1S6tFdwC" crossorigin="" />
    <style>
        /* Styler la carte (ajustez la hauteur selon vos besoins) */
        #map {
            margin-left: auto;
            margin-right: auto;
            width: 95%;
            height: 50vh;
            margin-top: 2.5rem;
        }
    </style>
    <title>LokaLoko</title>
</head>

<body>
    <header>
        <!--<h2 class="logo">Logo</h2>-->
        <img src="../images/logo_workshop.png" class="logo">
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
        </nav>
    </header>
    <div id='container'>

        <div id="map"></div>
        <div id='produits'>
            <div id='header-tab'>
                <p>Nom</p>
                <p>Prix</p>
                <p>Quantité</p>
                <p>Quantité désirée</p>
            </div>
            <div id='liste'>
            </div>
        </div>
    </div>

    <button id='btn'>Valider le panier</button>



    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script type="text/javascript">

        var latitude = <?= $latitude; ?>;
        var longitude = <?= $longitude; ?>;
        var entreprises = <?= $ent; ?>;
        console.log(entreprises);
        var is_affiche = ''
        function initMap() {
            // Créer une carte Leaflet avec une vue centrée et un zoom
            var map = L.map('map').setView([latitude, longitude], 13);

            // Ajouter une couche de carte (ex. OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            // Ajouter un marqueur
            L.marker([51.5, -0.09]).addTo(map)
                .bindPopup('Ceci est un marqueur personnalisé.');
            L.marker([latitude, longitude]).addTo(map).bindPopup('Ceci est votre position');
            for (const props in entreprises) {
                console.log(props)
                for (const rep in entreprises[props]) {
                    console.log(entreprises[props][rep][1]);
                    var element = L.marker([entreprises[props][rep][1], entreprises[props][rep][2]]).addTo(map).bindPopup(`${entreprises[props][rep][0]}`)
                    element.addEventListener('click', () => {
                        for (const prod in entreprises[props][rep][3]) {
                            document.getElementById('liste').innerHTML += `
                            <div class="produit">
                                <p>${prod}</p>
                                <p>${entreprises[props][rep][3][prod][0]}</p>
                                <p>${entreprises[props][rep][3][prod][1]}</p>
                                <div class='inp'>
                                    <input type="number" style='width: 95%;' placeholder="Quantité..." name="value">
                                </div>
                            </div>
                            `
                        }
                    })
                }
            }

            // Vous pouvez ajouter plus de marqueurs ou d'autres éléments ici
        }

        // Appeler la fonction initMap une fois que la page est chargée
        window.onload = function () {
            initMap();
        };
        console.log(latitude, longitude);

        function calculateDistance(lat1, lon1, lat2, lon2) {
            // Convertir les degrÃ©s en radians
            const deg2rad = (deg) => deg * (Math.PI / 180);

            // Rayon de la Terre en kilomÃ¨tres
            const R = 6371;

            // Convertir les latitudes et longitudes en radians
            const radLat1 = deg2rad(lat1);
            const radLon1 = deg2rad(lon1);
            const radLat2 = deg2rad(lat2);
            const radLon2 = deg2rad(lon2);

            // DiffÃ©rence de latitudes et de longitudes
            const dLat = radLat2 - radLat1;
            const dLon = radLon2 - radLon1;

            // Formule de la haversine pour calculer la distance
            const a = Math.sin(dLat / 2) ** 2 + Math.cos(radLat1) * Math.cos(radLat2) * Math.sin(dLon / 2) ** 2;
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distance = R * c;

            return distance;
        }



    </script>
</body>

</html>