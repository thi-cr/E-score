<?php


class Team
{
    private $id;
    private $nom;
    private $tag;
    private $idCapitaine;
    private $joueurs;
    private $games;

    /**
     * Team constructor.
     * @param $id
     * @param $nom
     * @param $tag
     * @param $idCapitaine
     * @param $joueurs
     */
    public function __construct($id, $nom, $tag, $idCapitaine, $joueurs = null, $games = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->tag = $tag;
        $this->idCapitaine = $idCapitaine;
        $this->joueurs = $joueurs;
        $this->games = $games;
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