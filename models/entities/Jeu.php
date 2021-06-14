<?php


class Jeu
{
    private $id;
    private $nom;
    private $equipe;

    /**
     * Jeu constructor.
     * @param $id
     * @param $nom
     * @param $equipe
     */
    public function __construct($id, $nom, $equipe = false)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->equipe = $equipe;
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