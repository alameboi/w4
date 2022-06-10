<?php

class UsersController {
    private $usersRep;

    public function __construct(UsersRepository $usersRep) {          
        $this->usersRep = $usersRep;
    }

    public function actionViewAll() : Response {
        $data = $this->usersRep->getUsersData();
        $usersData = [];
        foreach ($data as $row) {
            array_push($usersData, new UserData([
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'name' => $row['name'],
                'email' => $row['email'],
            ]));
        }

        $layoutData = ['title' => 'Users'];
        $pageTemplateData = ['usersData' => $usersData];

        return new Response('View', '', '', new View('ViewAll', $layoutData, $pageTemplateData));
    }

    public function actionAdd() : Response {
        if(isset($_POST["submit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            $email = $_POST["email"];

            try {
                $this->usersRep->addUser($username, $password, $name, $email);
                return new Response('Header', '/users');
            } catch (Exception $e) {
                return new Response('Error', '', $e->getMessage());
            }
        }

        $layoutData = ['title' => 'Add'];

        return new Response('View', '', '', new View('Add', $layoutData));
    }

    public function actionEdit(array $args) : Response {
        if(isset($_POST["edit"])) {
            $id = $_POST["id"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            $email = $_POST["email"];
        
            try {
                $this->usersRep->editUser($id, $username, $password, $name, $email);
                return new Response('Header', '/users');
            } catch (Exception $e) {
                return new Response('Error', '', $e->getMessage());
            }
        }

        
        try {
            $id = intval($args[0]);
            $user = $this->usersRep->getUserById(intval($id));

            $userData = new UserData([
                'id' => $id,
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            ]);


            $layoutData = ['title' => 'Edit'];
            $pageTemplateData = ['userData' => $userData];

            return new Response('View', '', '', new View('Edit', $layoutData, $pageTemplateData));

        } catch (Exception $e) {
            return new Response('Error', '', $e->getMessage());
        }
        
    }

    public function actionDelete(array $args) : Response {
        $id = intval($args[0]);
        try {
            $this->usersRep->deleteUser($id);
            return new Response('Header', '/users');
        } catch (Exception $e) {
            return new Response('Error', '', $e->getMessage());
        }
    }
}