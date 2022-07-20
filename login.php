<?php
require_once('./vendor/autoload.php');
spl_autoload_register();
use App\Business\UserService;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('app/Presentation');
$twig = new Environment($loader);
session_start();
if (isset($_POST['loginSubmit'])) {
    if (!empty($_POST['loginEmail']) || !empty($_POST['loginEmail'])) {
        $userSvc = new UserService();
        try {
            $user = $userSvc->login($_POST['loginEmail'], $_POST['loginPassword']);
            $_SESSION['user'] = $user;
            header('location: index.php?page=home');
        } catch (\Exception $ex) {
            //print($ex->getMessage());
            $error = 'Ongeldige login';
            print $twig->render("login.twig", array('error' => $error));
        }
    }
} else {
    print $twig->render("login.twig", array());
}
