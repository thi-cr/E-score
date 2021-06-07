<?php


class Teams
{
    private $id;
    private $nom;
    private $tag;
    private $idCapitaine;
    private $joueurs;
    private $jeux;

    /**
     * Teams constructor.
     * @param $id
     * @param $nom
     * @param $tag
     * @param $idCapitaine
     * @param $joueurs
     */
    public function __construct($id, $nom, $tag, $idCapitaine, $joueurs = null, $jeux = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->tag = $tag;
        $this->idCapitaine = $idCapitaine;
        $this->joueurs = $joueurs;
        $this->jeux = $jeux;
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