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
            SELECT * FROM users where id = :id;
            SQL, [
                'id' => $id
            ])
        );
    }

    public function getByUsername(string $username)  : Collection {
        return new Collection(
            UserProvider::query(<<<SQL
            SELECT * FROM users where username = :username;
            SQL, [
                'username' => $username
            ])
        );
    }

    public function create(array $data) : Collection {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $isAdmin = $data['admin'];

        $created = UserProvider::query(<<<SQL
        INSERT INTO users(username, email, password, admin) VALUES(:username, :email, :password, :isAdmin) RETURNING id;
        SQL, [
            'username'=> $username,
            'password'=> $password,
            'email'=> $email,
            'isAdmin' => $isAdmin
        ]);

        return new Collection([
            'id' => $created[0]['id'],
            ...$data
        ]);
    }
}