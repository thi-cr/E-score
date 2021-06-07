<?php


class Player
{
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $email;
    private $password;
    private $equipes;

    /**
     * Player constructor.
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $pseudo
     * @param $email
     * @param $password
     */
    public function __construct($id, $nom, $prenom, $pseudo, $email, $password, $equipes = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
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