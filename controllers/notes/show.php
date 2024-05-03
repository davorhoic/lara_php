<?php

//  zasad ćemo ručno ubaciti (iz index.php) konfiguraciju baze
$config = require 'config.php';
$db = new Database($config['database']);

$heading = "Note";
$currentUserId = 3;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

require "views/notes/show.view.php";