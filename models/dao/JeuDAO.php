<?php


class JeuDAO extends AbstractDAO
{
    public function __construct()
    {
        //appelle le constructeur du parent (AbstractDAO)
        parent::__construct('jeux');
    }


    public function create($result)
    {
        return new Jeu(
            $result["id"],
            $result["nom"]
        );
    }

    public function deepCreate($result)
    {
        return new Jeu(
            $result["id"],
            $result["nom"]

        );
    }
}