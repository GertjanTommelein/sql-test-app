<?php

namespace App\Entities;

class User {
    private $id;
    private $email;
    private $password;
    public $created_at;

    public function __construct($id, $email, $created_at)
    {
        $this->id = $id;
        $this->email = $email;
        $this->created_at = $created_at;
    }

    public function getId() : int {
        return $this->id;
    }
    public function getEmail() : String {
        return $this->email;
    }
}
