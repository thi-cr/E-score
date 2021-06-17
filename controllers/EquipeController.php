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

    public function edit($id)
    {
        $equipe = $this->dao->fetch($id);

        $joueurDAO = new JoueurDAO();
        $joueurs = $joueurDAO->fetchAll();

        include('../views/head.php');
        include('../views/equipes/edit.php');
        include('../views/foot.php');
    }

    public function update($id, $data)
    {

        $this->dao->update($id, $data);
        $equipes = $this->dao->fetchAll();
        $joueurDAO = new JoueurDAO();
        $joueur = $joueurDAO->fetch($data['capitaine_id']);
        $joueurs = $joueurDAO->fetchAll();

        $equipesJoueur = $this->dao->fetch($joueur->equipe->id);

        include('../views/head.php');
        include('../views/joueur/logged.php');
        include('../views/foot.php');
    }


    public function store($id, $data){
        $this->dao->store($id, $data);
    }
}