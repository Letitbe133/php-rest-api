<?php

// die('test');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// On envoie les headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With");

// On inclus les objets (ou classes) nécessaires
include_once "../../config/Database.php";
include_once "../../models/Post.php";

// On crée une nouvelle instance de connexion à la DB et on se connecte
$db = new Database();
$conn = $db->connect();

// On crée une nouvelle instance de l'objet (ou classe) Post
$post = new Post($conn);

if(!isset($_GET['id'])) {
    echo json_encode([
        "success" => false,
        "message" => "No post id provided"
    ]);
    die();
}

$id = $_GET['id'];

if($post->delete_post($id)) {

    echo json_encode([
        "success" => true,
        "message" => "Post $id deleted"
        ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Post $id could not be deleted"
        ]);
}

