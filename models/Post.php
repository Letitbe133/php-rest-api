<?php

class Post {
    // Propriétés privées de connexion à la DB
    private $conn;
    private $table = "posts";

    // Propriétés publiques de l'objet Post
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructeur : quand on instancie l'objet, on lui passe la connexion à la DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Récupérer la liste des posts
    public function read_posts() {

        // création de la requête
        $query = "
            SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM "
            . $this->table . " p
            LEFT JOIN
            categories c ON p.category_id = c.id
            ORDER BY
            p.created_at DESC";

        // préparation de la requête
        $stmt = $this->conn->prepare($query);

        // exécution de la requête
        $stmt->execute();

        // on retourne le résultat
        return $stmt;
    }

    // Récupérer un post
    public function read_single_post() {

        // création de la requête
        $query = "
        SELECT
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM "
        . $this->table . " p
        LEFT JOIN
        categories c ON p.category_id = c.id
        WHERE p.id = :id
        LIMIT 0,1";

        // préparation de la requête
        $stmt = $this->conn->prepare($query);

        // tableau associatif qui lie :id à l'id reçue en paramètre
        $params = ["id" => $this->id];

        // excécution de la requête
        if($stmt->execute($params)) {

            // on récupère le résultat et on le stocke dans une variable (type: array)
            $row = $stmt->fetch();
    
            return $row;
        }

        return false;

    }

    // Créer un post
    public function create_post() {

        // On crée la requête
        $query = "
            INSERT INTO "
            . $this->table .
            " SET
            title = :title,
            body = :body,
            author = :author,
            category_id = :category_id        
        ";

        // on prépare la requête
        $stmt = $this->conn->prepare($query);

        // On nettoie et sécurise les inputs
        // référence strip_tags(): https://www.php.net/manual/en/function.strip-tags.php
        // référence htmlspecialchars() : https://www.php.net/manual/en/function.htmlspecialchars.php 
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // tableau associatif pour lier les paramètres reçus à la requête
        $params = [
            "title" => $this->title,
            "body" => $this->body,
            "author" => $this->author,
            "category_id" => $this->category_id
        ];

        // on exécute la requête et on vérifie si elle s'est bien déroulée 
        if($stmt->execute($params)) {
            // Dans ce cas on retourne true
            return true;
        }

        // sinon on retourne false

        return false;
    }

        // Modifier un post
        public function update_post() {

            // On crée la requête
            $query = "
                UPDATE "
                . $this->table .
                " SET
                title = :title,
                body = :body,
                author = :author,
                category_id = :category_id
                WHERE
                id = :id        
            ";
    
            // on prépare la requête
            $stmt = $this->conn->prepare($query);
    
            // on nettoie et sécurise les inputs
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // tableau associatif pour lier les paramètres reçus à la requête
            $params = [
                "title" => $this->title,
                "body" => $this->body,
                "author" => $this->author,
                "category_id" => $this->category_id,
                "id" => $this->id
            ];
    
            // on exécute la requête et on vérifie si elle s'est bien déroulée
            if($stmt->execute($params)) {
    
                // dans ce cas on retourne true
                return true;
            }
    
            // sinon on retourne false
    
            return false;
        }
    

    // Effacer un post
    public function delete_post() {

        // On crée la requête
        $query = "
            DELETE
            FROM " . $this->table .
            " WHERE id = :id
        ";

        // on prépare la requête
        $stmt = $this->conn->prepare($query);

        // on nettoie et sécurise l'input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // tableau associatif pour lier les paramètres reçus à la requête
        $params = ["id" => $this->id];

        // on exécute la requête et on vérifie si elle s'est bien déroulée
        if($stmt->execute($params)) {

            // dans ce cas on retourne true
            return true;
        }

        // sinon on retourne false
        return false;

        
    }
}