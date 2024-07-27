<?php

function env(string $key, $default = null) {
    if(key_exists($key, $_ENV)) {
        return $_ENV[$key];
    }

    return $default;
}
