<?php


class Match extends AbstractDAO
{
    private $id;
    private $equipe1;
    private $equipe2;
    private $ScoreEquipe1;
    private $ScoreEquipe2;
    private $jeu;
    private $statut;
    private $idCreateur;

    /**
     * Match constructor.
     * @param $id
     * @param $equipe1
     * @param $equipe2
     * @param $ScoreEquipe1
     * @param $ScoreEquipe2
     * @param $jeu
     * @param $statut
     * @param $idCreateur
     */
    public function __construct($id, $equipe1, $equipe2, $ScoreEquipe1, $ScoreEquipe2, $jeu, $statut, $idCreateur)
    {
        $this->id = $id;
        $this->equipe1 = $equipe1;
        $this->equipe2 = $equipe2;
        $this->ScoreEquipe1 = $ScoreEquipe1;
        $this->ScoreEquipe2 = $ScoreEquipe2;
        $this->jeu = $jeu;
        $this->statut = $statut;
        $this->idCreateur = $idCreateur;
    }


    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }

    public function __set($prop, $value)
    {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }
}