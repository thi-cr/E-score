<?php


class JoueurController extends AbstractController
{
    public function __construct()
    {
        $this->dao = new JoueurDAO();
    }

    public function index()
    {
        $joueur = $this->isLogged();
        $EquipeDAO = new EquipeDAO();
        $equipes = $EquipeDAO->fetchAll();
        if ($joueur->equipe){
            $equipeJoueur = $EquipeDAO->fetch($joueur->equipe->id);
        }
        $joueurs = $this->dao->fetchAll();
        include('../views/head.php');
        include('../views/joueur/logged.php');
        include('../views/foot.php');
    }

    public function store($id, $data)
    {
        $this->dao->store(false, $data);
    }

    public function register($id, $data)
    {
        $this->store(false, $data);
        include('../views/head.php');
        include('../views/joueur/login/loginForm.php');
        include('../views/foot.php');
    }

    public function login($id, $data)
    {
        $joueur = $this->dao->verify($data);
        if ($joueur) {
            header('Location:/joueurs/index');
        } else {
            echo "erreur au login";
        }
    }


}