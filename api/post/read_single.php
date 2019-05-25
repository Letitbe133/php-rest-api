<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// On envoie les headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

// On inclus les objets (ou classes) nécessaires
include_once "../../config/Database.php";
include_once "../../models/Post.php";

// On crée une nouvelle instance de connexion à la DB et on se connecte
$db = new Database();
$conn = $db->connect();

// On crée une nouvelle instance de l'objet (ou classe) Post
$post = new Post($conn);

// On vérifie si l'id du post est bien passée en paramètre dans l'url
// Si non, on affiche un message d'erreur
if(!isset($_GET['id'])) {
    echo json_encode([
        "success" => false,
        "message" => "No post id provided"
    ]);
    die();
}

// Si oui, on récupère l'id et on la stocke dans une variable
$id = $_GET['id'];

// On utilise la méthode read_single_post() de l'objet Post
$result = $post->read_single_post($id);

if($result) {
    // On encode en JSON et on affiche
    echo json_encode([
        "success" => true,
        "data" => $result
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "No post found with id $post->id"
    ]);
}
