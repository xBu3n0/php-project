<?php
use App\Http\DataTransferObject;

class CreateUserDTO implements DataTransferObject {
    public function __construct(
        public string $username,
        public string $email,
        #[\SensitiveParameter]
        public string $password,
        public bool $admin,
        ...$garbage
    ) {}
    
    public function toArray(): array {
        return [
            "username"=> $this->username,
            "email"=> $this->email,
            "password"=> $this->password,
            "admin"=> $this->admin
        ];
    }

    public function validate() {
        $this->username = validate($this->username)->string()->min(5)->max(20)->get();
        $this->email    = validate($this->email)->string()->email()->suffix('@uepg.br')->get();
        $this->password = validate($this->password)->string()->min(1)->max(20)->get();
    }
}