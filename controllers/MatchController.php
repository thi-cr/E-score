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

    public function add($id, $data)
    {
        var_dump($data);
        var_dump($id);
        $joueurDAO = new JoueurDAO();
        $joueurs = $joueurDAO->fetchAll();
        $createur = $joueurDAO->fetch($data["createur"]);
        $equipeDAO = new EquipeDAO();
        $equipe1 = $equipeDAO->fetch($data["equipe1"]);
        $equipe2 = $equipeDAO->fetch($data["equipe2"]);
        $jeuDAO = new JeuDAO();
        $jeu = $jeuDAO->fetch($data["jeu"]);
        include('../views/head.php');
        include('../views/matchs/ajouter.php');
        include('../views/foot.php');
    }
}