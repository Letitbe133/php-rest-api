# PHP rest API

Le but : créer une API rest simple mais fonctionnelle permettant de réaliser des opérations CRUD sur une DB. 


# Steps

Les différentes étapes

## Création de la structure de fichiers

> php_rest_api/

>> api/

>>> post/
>>> create.php
>>> delete.php
>>> read_single.php
>>> read.php
>>> update.php

>> config/
>>> Database.php

>> models/
>>> Post.php


## Création de la base de données

> BDD : blogposts
>> Table : posts
>> Fields :
>>> **id**: int, AI  primary key
>>> **category_name**: varchar(50)  NOT NULL
>>> **title**: varchar(100)  NOT_NULL
>>> **body**: text  NOT_NULL
>>> **author**: varchar(50) NOT_NULL
>>> **created_at**: DATETIME DEFAULT 'CURRENT_TIMESTAMP' NOT_NULL

## config/
Le répertoire config/ contient un fichier **Database.php** qui va gérer la connexion à la DB

### Database.php
C'est un objet php (ou une classe) qui contient les propriétés et méthodes nécessaires à la connexion à la DB
Les propriétés seront en mode **private** et ne seront donc pas accessibles en dehors de la classe 

## models/
Le répertoire models/ contient un fichier **Post.php** qui va gérer requêtes **CRUD** à la DB

### Post.php
C'est un objet php (ou une classe) qui contient les propriétés et méthodes nécessaires pour requêter la DB
- read_posts()
- read_single_post()
- create_post()
- update_post()
- delete_post()

Ces méthodes ne feront que renvoyer le résultat des requêtes

## api/post/
Le répertoire api/post/ contient les fichiers qui sont en fait l'équivalent de routes qui vont appeler les méthodes correspondantes de l'objet **Post**
- Ex : **create.php** va appeler la méthode **create_post()**

### Liste des routes
- create.php
- delete.php
- read.php
- read_single.php
- update.php


## Utilisation
Pour vérifier ce que nous renvoie l'api, on utilisera **postman** pour simuler les requêtes en provenance du front

