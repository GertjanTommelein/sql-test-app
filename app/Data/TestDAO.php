<?php

namespace App\Data;
use App\Data\Database;
use App\Entities\Test;
use App\Entities\Question;
use App\Exceptions\TestDoesNotExistException;

class TestDAO {

    public function create($title, $created_by, $questions) {
        $db = new Database();
        $testSql = "INSERT INTO tests (title, created_by) VALUES (?, ?)";
        $testResult = $db->pQuery($testSql, 'si', [$title, $created_by]);
        $testId = $db->getLastInsertedId();
        $questionSql = "INSERT INTO questions (test_id ,title) VALUES (?, ?)";
        $testQuestions = [];
        foreach($questions as $question) {
            $db->pQuery($questionSql, 'is' ,[$testId, $question['title']]);
        }
    }
    public function getTestsByUser($id) {
        $db = new Database();
        $sql = "SELECT * FROM tests_assigned
            INNER JOIN tests on tests.id = tests_assigned.test_id
            WHERE tests_assigned.user_id = ?";
        $result = $db->pQuery($sql, 'i', $id)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getTestById($id) : Test {
        $db = new Database();
        $sql = "SELECT t.id, t.title, t.created_at, u.email, q.title as question_title FROM tests t
            INNER JOIN questions q on t.id = q.test_id
            INNER JOIN users u on t.created_by = u.id
            WHERE t.id = ?";
        if (!$result = $db->pQuery($sql, 'i', $id)->fetch_all(MYSQLI_ASSOC)) throw new TestDoesNotExistException();

        $questions = [];
        foreach ($result as $question) {
            array_push($questions, $question['question_title']);
        }
        $test = new Test((int)$result[0]['id'], $result[0]['title'], $result[0]['email'], $questions, $result[0]['created_at']);
        return $test;
    }
    
}
