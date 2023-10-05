<?php
session_start();



try {
    $bdd = new PDO("mysql:host=localhost;dbname=workshop", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
}

function getLatLon($adresse)
{
    $curl = curl_init();
    $adresse = str_replace(" ", "+", $adresse);
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-adresse.data.gouv.fr/search/?q=".$adresse,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo "yes";
    }
    return ['latitude' => json_decode($response)->features[0]->geometry->coordinates[1], 'longitude' => json_decode($response)->features[0]->geometry->coordinates[0]];
}


if (isset($_POST['numero_siret'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['email'];
    $password = $_POST['password'];
    $entname = $_POST['entname'];
    $address = $_POST['address'];
    $array_lat_lon = getLatLon($address);
    $latitude = $array_lat_lon['latitude'];
    $longitude = $array_lat_lon['longitude'];
    echo $latitude;
    echo $longitude;
    $id = 0;
    $id_ent = 0;

    try {
        $create_user = "INSERT INTO users (NOM,Prenom,Mail,Password, latitude, longitude, Type_compte, Profession) values('$nom','$prenom','$mail','$password',$latitude, $longitude,'Entreprise','Producteur')";
        $bdd->exec($create_user);
        $get_id = "SELECT ID FROM users where NOM = '$nom' and Prenom = '$prenom' and Mail = '$mail'";
        foreach ($bdd->query($get_id) as $rep) {
            $id = $rep['ID'];
        }
        $get_ent_id = "SELECT MAX(ID_Entreprise) as id from entreprise";
        foreach ($bdd->query($get_ent_id) as $identifiant) {
            $id_ent = $identifiant['id'] + 1;
        }

        $sql = "INSERT INTO entreprise (NOM, Mail, Password,ID_Entreprise, ID_user) values('$entname', 'mail', '$password', $id_ent, $id)";
        $bdd->exec($sql);

        $_SESSION['ent'] = $id_ent;
        

        header("Location: ../page/prodPartie.php");
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

} else {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['email'];
    $password = $_POST['password'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    try {

        $sql = "INSERT INTO users (NOM,Prenom,Mail,Password, latitude, longitude, Type_compte, Profession) values('$nom','$prenom','$mail','$password',$latitude, $longitude,'particulier','sexologue')";

        $bdd->exec($sql);

        $_SESSION['nom'] = $nom;
        $_SESSION['lat'] = $latitude;
        $_SESSION['lon'] = $longitude;

        $liste = [];

        $request_distance = "select ID , NOM, Latitude, Longitude from users where Type_compte = 'Entreprise'; ";

        foreach ($bdd->query($request_distance) as $req) {
            print_r($req);
                $id = $req['ID'];
                $request_product = "SELECT produits.NOM as nom, produits.Prix as prix, produits.Quantite as qte from users 
                inner join entreprise on users.ID = entreprise.ID_User
                INNER JOIN produits on entreprise.ID_Entreprise = produits.ID_Entreprise
                where users.ID = $id;";
                $liste_product = [];
                foreach ($bdd->query($request_product) as $req_prod) {
                    $liste_product[$req_prod['nom']] = [$req_prod['prix'], $req_prod['qte']];
                }

                if (empty($liste[$req['ID']])) {
                    $liste[$req['ID']] = array($req['NOM'], $req['Latitude'], $req['Longitude'], $liste_product);
                }
        }
        if (!empty($_SESSION['entreprises'])) {
            unset($_SESSION['entreprise']);
        }
        $_SESSION['entreprises'][] = $liste;
        header("Location: ../page/particulier_home.php");
    } catch (PDOException $exept) {
        echo $exept->getMessage();
    }
}


function distance($lat1, $lon1, $lat2, $lon2)
{
    // Rayon de la Terre en kilomètres
    $earthRadius = 6371;

    // Conversion des degrés en radians
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Différence de latitudes et de longitudes
    $latDiff = $lat2 - $lat1;
    $lonDiff = $lon2 - $lon1;

    // Formule de la distance haversine
    $a = sin($latDiff / 2) * sin($latDiff / 2) + cos($lat1) * cos($lat2) * sin($lonDiff / 2) * sin($lonDiff / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Distance en kilomètres
    $distance = $earthRadius * $c;

    return $distance;
}

?>