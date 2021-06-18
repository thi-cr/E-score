<?php


class IndexController extends AbstractController
{
    public function index()
    {
        $EquipeDAO = new EquipeDAO();
        $equipes = $EquipeDAO->fetchAll();
        include('../views/head.php');
        include('../views/joueur/login/loginForm.php');
        include('../views/foot.php');
    }
}