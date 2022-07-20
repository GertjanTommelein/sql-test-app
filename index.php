<?php

require_once('./vendor/autoload.php');
spl_autoload_register();
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Business\TestService;
use Controllers\TestController;

$loader = new FilesystemLoader('app/Presentation');
$twig = new Environment($loader);
session_start();
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'home') {
        $testSvc = new TestService();
        $assigned_tests = $testSvc->getTestsByUser($_SESSION['user']->getId());
        if (!isset($_GET['error'])) {
            print $twig->render("home.twig", [
                'user' => $_SESSION['user'],
                'assignments' => $assigned_tests
            ]);
        } else {
            print $twig->render("home.twig", [
                'user' => $_SESSION['user'],
                'assignments' => $assigned_tests,
                'error' => 'Test bestaat niet'
            ]);
        }
    }
    if ($_GET['page'] == 'test') {
        if (isset($_GET['id'])) {
            $testSvc = new TestService();
            try {
                if ($test = $testSvc->getTestById($_GET['id'])) {
                    print $twig->render("test.twig", ['test' => $test]);
                }
            } catch (\App\Exceptions\TestDoesNotExistException $ex) {
                header("location: index.php?page=home&error=true");
            }
        }
    }
}
