<?php

function connectDB()
{
    if ($_SERVER['SERVER_NAME'] == 'localhost') { //local
        $db = new PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } else { //online
        $db = new PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}

//récupération de toutes les données d'une table
function getAll($table)
{
    $db = connectDB();
    $query = $db->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//récupération des données d'une table en fonction d'un critère
function getOne($table, $critere, $valeur)
{
    $db = connectDB();
    $query = $db->prepare("SELECT * FROM $table WHERE $critere = :valeur");
    $query->bindValue(':valeur', $valeur, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}
//insertion des articles selectionner dans le panier
function insertPanier($id_produit, $id_client, $quantite)
{
    $db = connectDB();
    $query = $db->prepare("INSERT INTO panier (id_produit, id_client, quantite) VALUES (:id_produit, :id_client, :quantite)");
    $query->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $query->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $query->execute();
    return $query;
}