<?php
namespace App\Domains\User;

use App\Http\Controller;
use App\Http\Request;

class UserController extends Controller {
    public function __construct(
        protected readonly Request $request,
        private readonly UserService $UserService = new UserService()
    ) {}
    
    public function index() {
        return response()
            ->json($this->UserService->all())
            ->setStatus(200);
    }

    public function show() {
        $user = $this->UserService->getById($this->request->uri['id']);
        
        return $user;
        // return response()
        //     ->json($user)
        //     ->setStatus(200);
    }

    public function create() {

    }
}