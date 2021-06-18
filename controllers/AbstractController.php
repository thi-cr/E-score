<?php

abstract class AbstractController
{

    // pas de cookie --> return false
    // si cookie récup le joueur avec ce cookie
    public function getJoueur() {
        if (!isset($_COOKIE['session_token'])) {
            var_dump('no cookie!');
            return false;
        }
        $joueurDAO = new JoueurDAO();
        return $joueurDAO->fetchBySession($_COOKIE['session_token']);
    }

    public function isLogged() {
        $joueur = $this->getJoueur();
        if(!$joueur) {
            include('../views/joueur/login/loginForm.php');
            die;
        }
        return $joueur;
    }

    public function create()
    {
        var_dump('no create');
    }

    public function edit($id)
    {
        var_dump('no edit');
    }

    public function delete($id, $data)
    {
        var_dump('no delete');
    }

    public function show($id)
    {
        var_dump('no show');
    }

    public function update($id, $data)
    {
        var_dump('no update');
    }

    public function store($id, $data)
    {
        var_dump('no store');
    }

    public function index()
    {
        var_dump('no index');
    }

    public function add($id, $data)
    {
        var_dump('no add');
    }



}