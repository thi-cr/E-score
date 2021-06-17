<?php


class Match
{
    private $id;
    private $equipe1;
    private $equipe2;
    private $ScoreEquipe1;
    private $ScoreEquipe2;
    private $jeu;
    private $statut;
    private $createur_id;
    private $joueurs;
    private $lineup1;
    private $lineup2;

    /**
     * Match constructor.
     * @param $id
     * @param $equipe1
     * @param $equipe2
     * @param $ScoreEquipe1
     * @param $ScoreEquipe2
     * @param $jeu
     * @param $statut
     * @param $createur_id
     * @param $lineup1
     * @param $lineup2
     */
    public function __construct($id, $equipe1, $equipe2, $ScoreEquipe1, $ScoreEquipe2, $jeu, $statut, $createur_id, $lineup1 = false, $lineup2 = false)
    {
        $this->id = $id;
        $this->equipe1 = $equipe1;
        $this->equipe2 = $equipe2;
        $this->ScoreEquipe1 = $ScoreEquipe1;
        $this->ScoreEquipe2 = $ScoreEquipe2;
        $this->jeu = $jeu;
        $this->statut = $statut;
        $this->createur_id = $createur_id;
        $this->lineup1 = $lineup1;
        $this->lineup2 = $lineup2;
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