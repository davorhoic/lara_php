<?php

//  zasad ćemo ručno ubaciti (iz index.php) konfiguraciju baze
$config = require 'config.php';
$db = new Database($config['database']);

$heading = "Note";
$currentUserId=1;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET['id']
])->fetch();

if (!$note) {
    abort();
}

if (!$note <> $currentUserId) {
    abort(Response::FORBIDDEN);
}

require "views/note.view.php";
