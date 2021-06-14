<?php


class EquipeController extends AbstractController
{
    public function __construct(){
        $this->dao = new EquipeDAO();
    }

    public function index()
    {
        $equipes = $this->dao->fetchAll();
        include('../views/head.php');
        include('../views/equipes/list.php');
        include('../views/foot.php');
    }
}