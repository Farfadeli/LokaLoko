<?php
    session_start();
    $bdd = new PDO("mysql:host=localhost;dbname=workshop", 'root', '');
    $id = $_SESSION['ent'];
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    try{
        $sql = "INSERT INTO produits (NOM, Quantite,Prix, Type_produit, ID_entreprise, Service_demande) values('$nom', $quantite, $prix, 'vegetable', $id,'aucun')";

        $bdd->exec($sql);
        echo "La donnée à bien été ajouter";
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>