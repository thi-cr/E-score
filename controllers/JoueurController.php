<?php


class JoueurController extends AbstractController
{
    public function __construct(){
        $this->dao = new JoueurDAO();
    }

    public function index()
    {
        $personnes = $this->dao->fetchAll();

        //include('../views/head.php');
        include('../views/personnes/list.php');
        //include('../views/foot.php');
    }
}