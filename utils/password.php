<?php

function createPassword(string $password): string {
    $salt = base64_encode(random_bytes(16));
    $hash = hash('sha256', $salt.base64_encode($password));

    return $salt.'.'.$hash;
}

function validatePassword(string $password, string $salt, string $hashed): bool {
    $hash = hash('sha256', $salt.base64_encode($password));

    return $hash == $hashed;
}