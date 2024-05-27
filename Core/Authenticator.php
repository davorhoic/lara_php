<?php
namespace Core;

class Authenticator
{
    function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            // check the password
            if (password_verify($password, $user['password'])) {

                // mark that the user has logged in
                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }

        return false;
    }
    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}