<?php
namespace App\Domains\User;

use App\Http\Middleware;
use App\Http\Request;
use App\Providers\UserProvider;

class UserMiddleware implements Middleware {
    public function __construct(
        private readonly UserProvider $userProvider = new UserProvider()
    ) {}

    public function handle(Request &$request): bool {
        if($username = $request->body['username']) {
            $request->user = $this->userProvider->getByUsername($username)->toArray()[0];

            return true;
        }

        return false;
    }
}