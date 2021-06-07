<?php


class Joueur
{
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $email;
    private $password;
    private $equipes;

    /**
     * Joueur constructor.
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $pseudo
     * @param $email
     * @param $password
     * @param $teams
     */
    public function __construct($id, $nom, $prenom, $pseudo, $email, $password, $equipes = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->equipes = $teams;
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