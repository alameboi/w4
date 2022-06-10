<?php

class UserData {
    public int $id;
    public string $username;
    public string $password;
    public string $name;
    public string $email;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->name = $data['name'];
        $this->email = $data['email'];
    }
}