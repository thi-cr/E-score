<?php


class Match
{
    private $id;
    private $ScoreTeam1;
    private $ScoreTeam2;
    private $game;

    /**
     * Match constructor.
     * @param $id
     * @param $ScoreTeam1
     * @param $ScoreTeam2
     * @param $game
     */
    public function __construct($id, $ScoreTeam1, $ScoreTeam2, $game)
    {
        $this->id = $id;
        $this->ScoreTeam1 = $ScoreTeam1;
        $this->ScoreTeam2 = $ScoreTeam2;
        $this->game = $game;
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