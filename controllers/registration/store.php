<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// VALIDATE THE FORM INPUTS
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// CHECK IF ACCOUNT ALREADY EXISTS
$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();


//// IF YES, REDIRECT TO LOGIN PAGE
if ($user) {
    // someone with that account already exists
    header('location: /');
    exit();
} else {
    //// IF NOT, SAVE IT TO THE DB, AND THEN LOG USER IN, AND REDIRECT
    $db->query('INSERT INTO users(email, password) VALUES (:email, :password) ', [
        'email' => $email,
        'password' => $password
    ]);
}

// mark that the user has logged in

$_SESSION['user'] = [
    'email' => $email
];

header('location: /');
exit();



