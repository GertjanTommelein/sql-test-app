<?php
namespace Controllers;

use Controllers\Controller;

class TestController extends Controller {
    public function __construct()
    {
        $this->name = "test";
        $this->view = "test.twig";
    }
}
