<?php

namespace App\Providers;
use App\Http\Collection;
use App\Http\Provider;

class UserProvider extends Provider {
    protected string $table = "users";
    protected string $connection = 'pgsql';

    public function all() : Collection {
        return new Collection(
            UserProvider::query(<<<SQL
            SELECT * FROM users;
            SQL)
        );
    }

    public function getById(int $id) : Collection {
        return new Collection(
            UserProvider::query(<<<SQL
            SELECT * FROM users where id=$id;
            SQL)
        );
    }

    public function create(array $data) : Collection {
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];

        $created = UserProvider::query(<<<SQL
        INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password') RETURNING id;
        SQL);

        return new Collection([
            'id' => $created[0]['id'],
            ...$data
        ]);
    }
}