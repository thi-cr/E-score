<?php


class MatchController extends AbstractController
{
    public function __construct()
    {
        $this->dao = new MatchDAO();
    }

    public function index()
    {
        $matchs = $this->dao->fetchAll();
        $jeuDAO = new JeuDAO();
        $jeux = $jeuDAO->fetchAll();
        $equipeDAO = new EquipeDAO();
        $equipes = $equipeDAO->fetchAll();
        include('../views/head.php');
        include('../views/matchs/list.php');
        include('../views/foot.php');
    }
}