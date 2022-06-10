<?php
declare(strict_types=1);
include_once ROOT . "/functions/validation.php";

class UsersRepository {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function getUsersData() {
        try {
            return $this->db->getData("SELECT * FROM users");
        } catch (Exception $e) {
            echo "getUsersData caught exception: " . $e->getMesage();
        }
    }

    public function addUser(string $username, string $password, string $name, string $email) {
        try {
            $user = new User($username, $password, $name, $email);
        
            if (usernameTaken($this->db, $user->getUsername())) {
                throw new Exception("username taken");
            }

            if (emailTaken($this->db, $user->getEmail())) {
                throw new Exception("email taken");
            }

            $sql = "INSERT INTO users(username, password, name, email) VALUES(?, ?, ?, ?)";
            
            try {
                $this->db->execute($sql, [$user->getUsername(), $user->getPassword(), $user->getName(), $user->getEmail()]);
            } catch (Exception $e) {
                throw new Exception("addUser caught exception: " . $e->getMesage());
            }
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function editUser(int $id, string $username, string $password, string $name, string $email) {
        try {
            $user = new User($username, $password, $name, $email, $id);
            
            if (usernameTaken($this->db, $user->getUsername(), $user->getId())) {
                throw new Exception("username taken");
            }

            if (emailTaken($this->db, $user->getEmail(), $user->getId())) {
                throw new Exception("username taken");
            }

            $sql = "UPDATE users SET username=?, password=?, name=?, email=? WHERE id=$id";
            
            try {
                $this->db->execute($sql, [$user->getUsername(), $user->getPassword(), $user->getName(), $user->getEmail()]);
            } catch (Exception $e) {
                throw new Exception("editUser caught exception: " . $e->getMesage());
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteUser(int $id) {
        $sql = "DELETE FROM users WHERE id=$id";
        
        try {
            $this->db->execute($sql);
        } catch (Exception $e) {
            throw new Exception("deleteUser caught exception: " . $e->getMesage());
        }
    }

    public function getUserById(int $id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        $data = $this->db->getData($sql);

        if (!$data) {
            throw new Exception("id doesn't exist");
        }
        
        $row = $data[0];
        $user = new User($row['username'], $row['password'], $row['name'], $row['email'], intval($row['id']));
        return $user;
    }
}