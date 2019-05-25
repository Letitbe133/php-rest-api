<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// On envoie les headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With");


// On inclus les objets (ou classes) nécessaires
include_once "../../config/Database.php";
include_once "../../models/Post.php";

// On crée une nouvelle instance de connexion à la DB et on se connecte
$db = new Database();
$conn = $db->connect();

// On crée une nouvelle instance de l'objet (ou classe) Post
$post = new Post($conn);

// Si données en json
// $data = json_decode(file_get_contents("php://input"));

// $post->title = $data->title;
// $post->body = $data->body;
// $post->author = $data->author;
// $post->category_id = $data->category_id;


    $id = $_GET['id'];

    // si données formdata
    $data = [];
    $data['title'] = $_POST['title'];
    $data['author'] = $_POST['author'];
    $data['body'] = $_POST['body'];
    $data['category_name'] = $_POST['category_name'];

if($post->update_post($id, $data)) {
    echo json_encode([
        "success" => true,
        "message" => "Post successfully updated"
        ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Post could not updated"
        ]);
}



