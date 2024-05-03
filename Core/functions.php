<?php
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);  // pretvara array u varijable (ime=key, vrijednost=value)
    // $heading = 'Home'
    require base_path('views/' . $path);
}
//print_r("functions.php loaded");