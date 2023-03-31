<?php


const DB_HOST = '127.0.0.1';
const DB_NAME = 'BDD-Site';
const DB_CHARSET = 'utf8';
const DB_USER = 'root';
const DB_PASS = '';




include_once __DIR__ . '/connect.php';
$db = connectDB();

function getAll($table): bool|array
{
    global $db;
    $query = $db->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        echo "Erreur, aucune valeur n'a été trouvée dans la table $table";
    }
    return $result;
}

function getOne($table, $critere, $valeur)
{
    global $db;
    $query = $db->prepare("SELECT * FROM $table WHERE $critere = :valeur");
    $query->bindValue(':valeur', $valeur, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        echo "Erreur, la valeur $valeur n'a pas été trouvée dans la table $table";
    }
    return $result;
}

function insertPanier($id_produit, $id_client, $quantite): void
{
    global $db;
    $query = $db->prepare("INSERT INTO commande (id_produit, id_client, qte_produit, date_commande) VALUES (:id_produit, :id_client, :quantite, CURRENT_DATE)");
    $query->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $query->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    if($query->execute()){
        echo "L'insertion dans la table commande a été effectuée avec succès";
    } else {
        echo "Erreur lors de l'insertion dans la table commande";
    }
}
//calcul du nombre total de produits dans le panier
function countPanier($id_client)
{
    global $db;
    $query = $db->prepare("SELECT COUNT(*) FROM commande WHERE id_client = :id_client");
    $query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        echo "Erreur, la valeur $id_client n'a pas été trouvée dans la table commande";
    }
    return $result;
}
//calcul du prix total du panier
function totalPanier($id_client)
{
    global $db;
    $query = $db->prepare("SELECT SUM(prix_produit * qte_produit) AS total FROM produit INNER JOIN commande ON produit.id_produit = commande.id_produit WHERE id_client = :id_client");
    $query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        echo "Erreur, la valeur $id_client n'a pas été trouvée dans la table commande";
    }
    return $result;
}
//affichage du panier
function getPanier($id_client)
{
    global $db;
    $query = $db->prepare("SELECT * FROM produit INNER JOIN commande ON produit.id_produit = commande.id_produit WHERE id_client = :id_client");
    $query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        echo "Erreur, la valeur $id_client n'a pas été trouvée dans la table commande";
    }
    return $result;
}
//suppression d'un produit du panier
function deletePanier($id_produit, $id_client)
{
    global $db;
    $query = $db->prepare("DELETE FROM commande WHERE id_produit = :id_produit AND id_client = :id_client");
    $query->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    if($query->execute()){
        echo "La suppression dans la table commande a été effectuée avec succès";
    } else {
        echo "Erreur lors de la suppression dans la table commande";
    }
}
//suppression de tous les produits du panier
function deleteAllPanier($id_client)
{
    global $db;
    $query = $db->prepare("DELETE FROM commande WHERE id_client = :id_client");
    $query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    if($query->execute()){
        echo "La suppression dans la table commande a été effectuée avec succès";
    } else {
        echo "Erreur lors de la suppression dans la table commande";
    }
}
//ajout d'un produit dans la table produit
function insertProduit($nom_produit, $prix_produit, $description_produit, $image_produit): void
{
    global $db;
    $query = $db->prepare("INSERT INTO produit (nom_produit, prix_produit, description_produit, image_produit) VALUES (:nom_produit, :prix_produit, :description_produit, :image_produit)");
    $query->bindValue(':nom_produit', $nom_produit, PDO::PARAM_STR);
    $query->bindValue(':prix_produit', $prix_produit, PDO::PARAM_INT);
    $query->bindValue(':description_produit', $description_produit, PDO::PARAM_STR);
    $query->bindValue(':image_produit', $image_produit, PDO::PARAM_STR);
    if($query->execute()){
        echo "L'insertion dans la table produit a été effectuée avec succès";
    } else {
        echo "Erreur lors de l'insertion dans la table produit";
    }
}
//suppression d'un produit dans la table produit
function deleteProduit($id_produit): void
{
    global $db;
    $query = $db->prepare("DELETE FROM produit WHERE id_produit = :id_produit");
    $query->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    if($query->execute()){
        echo "La suppression dans la table produit a été effectuée avec succès";
    } else {
        echo "Erreur lors de la suppression dans la table produit";
    }
}
//modification d'un produit dans la table produit
function updateProduit($id_produit, $nom_produit, $prix_produit, $description_produit, $image_produit): void
{
    global $db;
    $query = $db->prepare("UPDATE produit SET nom_produit = :nom_produit, prix_produit = :prix_produit, description_produit = :description_produit, image_produit = :image_produit WHERE id_produit = :id_produit");
    $query->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $query->bindValue(':nom_produit', $nom_produit, PDO::PARAM_STR);
    $query->bindValue(':prix_produit', $prix_produit, PDO::PARAM_INT);
    $query->bindValue(':description_produit', $description_produit, PDO::PARAM_STR);
    $query->bindValue(':image_produit', $image_produit, PDO::PARAM_STR);
    if($query->execute()){
        echo "La modification dans la table produit a été effectuée avec succès";
    } else {
        echo "Erreur lors de la modification dans la table produit";
    }
}
//calcul du stock total
function totalStock()
{
    global $db;
    $query = $db->prepare("SELECT SUM(qte_produit) AS total FROM produit");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        echo "ERREUR STOCK MANQUANT";
    }
    return $result;
}
//calcul du stock par produit
function stockProduit($id_produit)
{
    global $db;
    $query = $db->prepare("SELECT qte_produit FROM produit WHERE id_produit = :id_produit");
    $query->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        echo "Erreur, la valeur $id_produit n'a pas été trouvée dans la table produit";
    }
    return $result;
}
//stock catégorie ou genre
function stockType($table): string
{
    global $db;
    $query = $db->prepare("SELECT SUM(qte_produit) AS total FROM produit INNER JOIN $table ON produit.id_$table = $table.id_$table");
    //$query->bindValue(':table', $table, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(!$result){
        echo "Erreur, la valeur $table n'a pas été trouvée dans la table produit";
    }
    return implode(" ",$result);
}

