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
        //include('../views/foot.php');
    }

    public function add($id, $data)
    {
        $joueurDAO = new JoueurDAO();
        $lineup1 = $joueurDAO->fetchWhere('equipe_id', $data["equipe1"]);
        $lineup2 = $joueurDAO->fetchWhere('equipe_id', $data["equipe2"]);
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


    public function store($id, $data)
    {
        $this->dao->store(false, $data);
        header('Location:/joueurs/index');
    }

    public function edit($id)
    {
        $match = $this->dao->fetch($id);
        if ($match) {
            $equipeDAO = new EquipeDAO();
            $equipe1 = $equipeDAO->fetch($match->equipe1);
            $equipe2 = $equipeDAO->fetch($match->equipe2);
            $joueurDAO = new JoueurDAO();
            $lineup1 = $joueurDAO->fetchWhere('equipe_id', $match->equipe1);
            $lineup2 = $joueurDAO->fetchWhere('equipe_id', $match->equipe2);
            include('../views/head.php');
            include('../views/matchs/edit.php');
            include('../views/foot.php');
        }
        else{
            echo 'Match introuvable';
        }
    }


    public function update($id, $data)
    {

        $this->dao->update($id, $data);
        header('Location:/joueurs/index');
    }

    public function delete($id, $data)
    {
        $this->dao->delete($data);
        header('Location:/joueurs/index');
    }
}