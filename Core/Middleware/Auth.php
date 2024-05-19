<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        // provjerimo je li user ulogiran
        if (!$_SESSION['user'] ?? false) {
            header('location: /');
            exit();
            // poslije headera uvijek ide exit
        }
    }

}
