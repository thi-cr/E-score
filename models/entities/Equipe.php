<?php


class Equipe extends AbstractDAO
{
    private $id;
    private $nom;
    private $tag;
    private $idCapitaine;
    private $joueurs;
    private $jeux;
    private $matchs;

    /**
     * Equipe constructor.
     * @param $id
     * @param $nom
     * @param $tag
     * @param $idCapitaine
     * @param $joueurs
     * @param $jeux
     * @param $matchs
     */
    public function __construct($id, $nom, $tag, $idCapitaine, $joueurs = false, $jeux = false, $matchs = false)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->tag = $tag;
        $this->idCapitaine = $idCapitaine;
        $this->joueurs = $joueurs;
        $this->jeux = $jeux;
        $this->matchs = $matchs;
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