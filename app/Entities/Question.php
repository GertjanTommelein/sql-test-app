<?php
namespace App\Entities;

class Question {
    private $id;
    private $title;
    private $answer;

    public function __construct($id, $title, $answer = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->answer = $answer;
    }

    public function getId() : int {
        return $this->id;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getTitle() : String {
        return $this->title;
    }
    public function setAnswer($answer) {
        $this->answer = $answer;
    }
    public function getAnswer() : String {
        return $this->answer;
    }
}
