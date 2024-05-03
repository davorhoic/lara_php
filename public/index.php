<?php

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "Core/functions.php";  // za ovo ne možemo koristiti base_path funkciju 
// jer se sama nalazi u functions.php

spl_autoload_register(function ($class) {
    // $class="Core\Database"
    // da vidimo kako ćemo to translatirati
    // prvo ćemo promijeniti \ u /
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class); // "Core/Database"
    require base_path("{$class}.php"); // ne treba nam više prefix Core/
});

require base_path("Core/router.php");





