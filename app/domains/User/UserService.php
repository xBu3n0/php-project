<?php
namespace App\Domains\User;
use App\Http\Collection;
use App\Providers\UserProvider;

class UserService {
    public function __construct(
        private UserProvider $userProvider = new UserProvider()
    ) {

    }
    
    public function all(): Collection {
        return $this->userProvider->all();
    }

    public function getById($id): Collection {
        return $this->userProvider->getById($id);
    }

    public function create(array $data): Collection {
        return $this->userProvider->create($data);
    }
}