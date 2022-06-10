<?php
declare(strict_types=1);

class User {
    private int $id;
    private string $username;
    private string $password;
    private string $name;
    private string $email;

    public function setName(string $name): User {
        if (!preg_match("/^[A-Z][a-z]{1,19}$/", $name)) { //maybe move to validation?
            throw new Exception ("Invalid name");
        }

        $this->name = $name;
        return $this;
    }

    public function setUsername(string $username): User {
        if (!preg_match("/^[A-Za-z0-9]{1,30}$/", $username)) {
            throw new Exception ("Invalid username");
        }

        $this->username = $username;
        return $this;
    }

    public function setPassword(string $password): User {
        if (!preg_match("/^[A-Za-z0-9]{1,30}$/", $password)) {
            throw new Exception ("Invalid password");
        }

        $this->password = $password;
        return $this;
    }

    public function setEmail(string $email): User {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 60) {
            throw new Exception ("Invalid email");
        }

        $this->email = $email;
        return $this;
    }

    public function __construct(string $username, string $password, string $name, string $email, int $id = 0) {
        $this->id = $id;

        try {
            $this->setUsername($username)->setPassword($password)->setName($name)->setEmail($email);
        } catch (Exception $e) {
            throw new Exception ("User caught exception: " . $e->getMessage()); 
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }
}