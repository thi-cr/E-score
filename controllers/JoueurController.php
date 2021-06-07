<?php


class JoueurController extends AbstractController
{
    public function __construct(){
        $this->dao = new JoueurDAO();
    }

    public function index()
    {
        include('../views/head.php');
        include('../views/joueur/login/loginForm.php');
        include('../views/foot.php');
    }

}