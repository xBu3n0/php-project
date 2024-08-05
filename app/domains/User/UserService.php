<?php
namespace App\Domains\User;
use App\Http\Collection;
use App\Providers\UserProvider;
use CreateUserDTO;

class UserService {
    public function __construct(
        private UserProvider $userProvider = new UserProvider()
    ) {}
    
    public function all(): Collection {
        return $this->userProvider->all();
    }

    public function getById($id): Collection {
        return $this->userProvider->getById($id);
    }

    public function create(CreateUserDTO $user): Collection {
        $user->password = createPassword($user->password);

        return $this->userProvider->create($user->toArray());
    }
}