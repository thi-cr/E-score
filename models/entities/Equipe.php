<?php


class Equipe extends AbstractDAO
{
    private $id;
    private $nom;
    private $tag;
    private $capitaine_id;
    private $joueurs;
    private $jeux;
    private $matchs;

    /**
     * Equipe constructor.
     * @param $id
     * @param $nom
     * @param $tag
     * @param $capitaine_id
     * @param $joueurs
     * @param $jeux
     * @param $matchs
     */
    public function __construct($id, $nom, $tag, $capitaine_id, $joueurs = false, $jeux = false, $matchs = false)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->tag = $tag;
        $this->capitaine_id = $capitaine_id;
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