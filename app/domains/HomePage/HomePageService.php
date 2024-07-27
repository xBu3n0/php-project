<?php
namespace App\Domains\HomePage;

class HomePageService {
    private $users = [
        [
            "id"=> "1",
            "title"=> "Title",
            "description" => "Description"
        ],
        [
            "id"=> "2",
            "title"=> "2",
            "description"=> "2",
        ],
    ];
    
    public function all(): array {
        return $this->users;
    }

    public function getById(int $id): array {
        return $this->users[$id] ?? [];
    }
}