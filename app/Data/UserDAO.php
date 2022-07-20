<?php
namespace App\Data;
use App\Data\Database;
use App\Entities\User;
use App\Exceptions\loginInvalidException;

class UserDAO {
    public function create($email, $password, $role =  2) {
        $db = new Database();
        $sql = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";

        $db->pQuery($sql, 'ssi', [$email ,$password, $role]);
    }
    public function read($id = false) {
        $db = new Database();
        $sql = "SELECT * FROM users" . ($id ? "WHERE id = ?" : "");
        // if $id = true, fetch user with that id else fetch all
        $result = $id ? $db->pQuery($sql, 'i', $id)->fetch_all(MYSQLI_ASSOC) : $db->pQuery($sql)->fetch_all(MYSQLI_ASSOC);
        $user_list = [];
        foreach($result as $row) {
            $user = new User((int)$row['id'], $row['email'], $row['created_at']);
            array_push($user_list, $user);
        }
        return $user_list;
    }
    public function delete($id = false) {
        $db = new Database();
        $sql = "DELETE FROM users WHERE id = ?";
        $db->pQuery($sql, 'i', $id);
    }
    public function login($email, $password) {
        $sql = "SELECT id, email, password, created_at FROM users WHERE email = ?";
        $db = new Database();
        $result = $db->pQuery($sql, 's', [$email]);
        if (!($row = $result->fetch_assoc())) throw new loginInvalidException('Ongeldige login');
        if (password_verify($password, $row['password'] == null ? '' : $row['password'])) {
            $user = new User($row['id'] ,$row['email'], $row['created_at']);
            return $user;
        } else {
            throw new loginInvalidException('Ongeldige login');
            return NULL;
        }
    }
}
