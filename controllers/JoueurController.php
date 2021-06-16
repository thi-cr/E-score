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


    public function store($id, $data){
        $this->dao->store(false,$data);
    }

    public function register($id,$data){
        var_dump("in register",$data);
        //$this->$this->store(false, $data);
        $this->store(false,$data);
    }

    public function login($id,$data){
        $joueur = $this->dao->verify($data);
        var_dump($joueur);
        if($joueur){
            $joueur = $this->dao->fetchWhere('id', $joueur->id);
            $EquipeDAO = new EquipeDAO();
            $equipes = $EquipeDAO->fetchAll();
            include('../views/head.php');
            include('../views/joueur/logged.php');
            include('../views/foot.php');
        }else{
            echo "erreur au login";
        }
    }


}