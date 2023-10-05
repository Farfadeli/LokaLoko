<?php
session_start();
$mail = $_POST['email'];
$password = $_POST['password'];
try{
    $bdd = new PDO("mysql:host=localhost;dbname=workshop", "root", "");
}
catch(PDOException $e){
    echo $e->getMessage();
}


try {
    $can_connect = false;
    $sql = "SELECT COUNT(ID) as val FROM users where Mail = '$mail' and Password = '$password'";
    echo "nic";
    $latitude = 0;
    $longitude = 0;
    foreach ($bdd->query($sql) as $res) {
        if ($res['val'] == 1) {
            $can_connect = true;

            $request = "SELECT latitude,longitude from users where Mail = '$mail' and Password = '$password'";
            foreach($bdd->query($request) as $latlon){
                $latitude = $latlon['latitude'];
                $longitude = $latlon['longitude'];
                $_SESSION['lat'] = $latitude;
                $_SESSION['lon'] = $longitude;
            }


        } else {
            echo 'no';
        }
    }

    
    $liste = [];
        $request_distance = "SELECT ID , NOM, Latitude, Longitude FROM users WHERE Type_compte = 'Entreprise'; ";

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

    

}catch(PDOException $e){
    echo $e->getMessage();
}

?>