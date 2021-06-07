<?php


class Match
{
    private $id;
    private $ScoreEquipe1;
    private $ScoreEquipe2;
    private $jeu;

    /**
     * Match constructor.
     * @param $id
     * @param $ScoreEquipe1
     * @param $ScoreEquipe2
     * @param $jeu
     */
    public function __construct($id, $ScoreEquipe1, $ScoreEquipe2, $jeu)
    {
        $this->id = $id;
        $this->ScoreEquipe1 = $ScoreEquipe1;
        $this->ScoreEquipe2 = $ScoreEquipe2;
        $this->jeu = $jeu;
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