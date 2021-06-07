<?php


class Jeu extends AbstractDAO
{
    private $id;
    private $nom;
    private $equipes;

    /**
     * Jeu constructor.
     * @param $id
     * @param $nom
     * @param $equipes
     */
    public function __construct($id, $nom, $equipes = false)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->equipes = $equipes;
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