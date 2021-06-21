<?php


class EquipeController extends AbstractController
{
    public function __construct()
    {
        $this->dao = new EquipeDAO();
    }

    public function index()
    {
        $equipes = $this->dao->fetchAll();
        include('../views/head.php');
        include('../views/equipes/list.php');
    }

    public function edit($id)
    {
        $this->isLogged();
        $equipe = $this->dao->fetch($id);

        $joueurDAO = new JoueurDAO();
        $joueurs = $joueurDAO->fetchAll();
        $jeuDAO = new JeuDAO();
        $jeux = $jeuDAO->fetchAll();

        include('../views/head.php');
        include('../views/equipes/edit.php');
        include('../views/foot.php');
    }

    public function update($id, $data)
    {

        $this->dao->update($id, $data);
        header('Location:/joueurs/index');
    }


    public function store($id, $data)
    {
        $this->dao->store($id, $data);
        header('Location:/joueurs/index');
    }
}