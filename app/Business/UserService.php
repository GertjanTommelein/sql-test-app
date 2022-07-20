<?php
namespace App\Business;
use App\Data\UserDao;
use App\Exceptions\NotAValidEmailException;
use App\Exceptions\loginInvalidException;

class UserService {
    public function create($email, $password, $role = 2) {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            // E-mail is valid
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userDAO = new UserDAO();
            return $userDAO->create($email, $hashedPassword, $role);
        } else {
            throw new NotAValidEmailException();
        }
    }
    public function read($id = false) {
        $userDAO = new UserDAO();
        return $userDAO->read();
    }
    public function delete(int $id) {
        

    }
    public function login($email, $password) {
        $userDAO = new UserDAO();
        if ($user = $userDAO->login($email, $password)) {
            return $user;
        } else {
            throw new loginInvalidException();
        }
    }
}
