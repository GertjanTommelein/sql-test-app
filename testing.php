<?php
require('./vendor/autoload.php');
use App\Data\Database;
use App\Business\UserService;
use App\Data\UserDAO;
use App\Business\TestService;

$userDAO = new UserDAO();
$userSvc = new UserService();
$testSvc = new TestService();

// $questions = [
//     ['title' => 'Hoe selecteer je alle kolommen van de tabel users'],
//     ['title' => 'Hoe selecteer je alleen maar de username en password van de tabel users']
// ];
// $testSvc->create('SQL-beginner',1,$questions);
print '<pre>';
try {
    print_r($testSvc->getTestById(1));
    //code...
} catch (\App\Exceptions\TestDoesNotExistException $ex) {
    print $ex->getMessage();
}
