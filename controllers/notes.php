<?php

//  zasad ćemo ručno ubaciti (iz index.php) konfiguraciju baze
$config = require 'config.php';
$db = new Database($config['database']);

$heading="My Notes";

$notes=$db->query('select * from notes where user_id = 2')->fetchAll();

require "views/notes.view.php";
