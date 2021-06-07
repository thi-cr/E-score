<?php


class Match extends AbstractDAO
{
    private $id;
    private $ScoreEquipe1;
    private $ScoreEquipe2;
    private $jeu;
    private $statut;

    /**
     * Match constructor.
     * @param $id
     * @param $ScoreEquipe1
     * @param $ScoreEquipe2
     * @param $jeu
     */
    public function __construct($id, $ScoreEquipe1, $ScoreEquipe2, $jeu, $statut)
    {
        $this->id = $id;
        $this->ScoreEquipe1 = $ScoreEquipe1;
        $this->ScoreEquipe2 = $ScoreEquipe2;
        $this->jeu = $jeu;
        $this->statut = $statut;
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