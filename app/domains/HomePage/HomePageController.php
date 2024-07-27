<?php
namespace App\Domains\HomePage;

use App\Http\Controller;
use App\Http\Request;

class HomePageController extends Controller {
    public function __construct(
        protected readonly Request $request,
        private readonly HomePageService $homePageService = new HomePageService()
    ) {}
    
    public function index() {
        return response(
                $this->homePageService->all()
            )
            ->setHeaders(['Content-Type' => 'application/json'])
            ->setStatus(200);
    }

    public function show() {
        return response()
            ->json($this->homePageService->getById($this->request->url['id']))
            ->setStatus(200);
            // ->setCookie(["a", "20", 360]);
    }
}