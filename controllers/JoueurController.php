<?php


class JoueurController extends AbstractController
{
    public function __construct(){
        $this->dao = new JoueurDAO();
    }

    public function index()
    {
        $EquipeDAO = new EquipeDAO();
        $equipes = $EquipeDAO->fetchAll();
        include('../views/head.php');
        include('../views/joueur/login/loginForm.php');
        include('../views/foot.php');
    }

}