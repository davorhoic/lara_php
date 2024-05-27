<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

// VALIDATE THE FORM INPUTS

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

// check if the credentials match
$signedIn = (new Authenticator)->attempt(
    $attributes['email'],
    $attributes['password']
);

if (!$signedIn) {

    $form->error(
        'email',
        'No matching account for that email address and password!'
    )->throw();

}

redirect('/');



