<?php


class Joueur
{
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $email;
    private $password;
    private $equipe;
    private $session_token;
    private $session_time;

    /**
     * joueur constructor.
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $pseudo
     * @param $email
     * @param $password
     * @param $equipe
     */
    public function __construct($id, $nom, $prenom, $pseudo, $email, $password, $equipe = false, $session_token = false, $session_time = false)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->equipe = $equipe;
        $this->session_token = $session_token;
        $this->session_time = $session_time;
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