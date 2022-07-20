<?php
namespace App\Entities;

class Test {
    private $id;
    private $title;
    private $created_by;
    private $questions = [];
    private $answers = [];
    public $created_at;

    public function __construct($id, $title, $created_by, $questions, $created_at, $answers = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->created_by = $created_by;
        $this->questions = count($questions) > 0 ? $questions : [];
        $this->answers = $answers;
        $this->created_at = $created_at;
    }

    public function getId() : int {
        return $this->id;
    }
    public function getTitle() : String {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getCreated_by() : User {
        return $this->created_by;
    }
    public function getQuestions() : Array {
        return $this->questions;
    }
    public function setQuestions($questions) {
        $this->questions = $questions;
    }
    public function getAnswers() : Array {
        return $this->answers;
    }
    public function setAnswers($answers) {
        $this->answers = $answers;
    }
}
