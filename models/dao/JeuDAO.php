<?php


class JeuDAO extends AbstractDAO
{
    public function __construct()
    {
        //appelle le constructeur du parent (AbstractDAO)
        parent::__construct('jeux');
    }

    public function equipe($jeu_id)
    {
        return $this->belongsToMany(new EquipeDAO(), 'equipe_jeu', $jeu_id, 'jeu_id', 'equipe_id');
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
            $result["nom"],
            $this->equipe($result["id"])
        );
    }
}