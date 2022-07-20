<?php
namespace App\Business;
use App\Data\TestDAO;

class TestService {
    public function create($title, $created_by, $questions) {
        $testDAO = new TestDAO();
        $testDAO->create($title, $created_by, $questions);
    }
    public function getTestsByUser($id) {
        $testDAO = new TestDAO();
        return $testDAO->getTestsByUser($id);
    }
    public function getTestById($id) {
        $testDAO = new TestDAO();
        return $testDAO->getTestById($id);
    }
}
