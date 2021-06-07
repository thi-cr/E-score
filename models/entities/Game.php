<?php


class Game
{
    private $id;
    private $nom;
    private $teams;

    /**
     * Game constructor.
     * @param $id
     * @param $nom
     * @param $teams
     */
    public function __construct($id, $nom, $teams = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->teams = $teams;
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