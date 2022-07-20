<?php
namespace Controllers;
spl_autoload_register();
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class Controller {
    private $name;
    private $view;
    private $data = [];
    public $twig;

    public function __construct($name, $view)
    {
        $this->name = $name;
        $this->view = $view;
        $loader = new FilesystemLoader('../app/Presentation');
        $twig = new Environment($loader);
        $this->twig = $twig;
    }
    public function getView() {
        print($this->twig->render($this->view, $this->data));
    }
    public function setData($data) {
        $this->data = $data;
    }
    public function getData() : Array {
        return $this->data;
    }
    public function pushData($data) {
        array_push($this->data, $data);
    }
}
