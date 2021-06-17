<?php


class Equipe
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

    public function has_joueur ($joueur_id) {
        //detecter si dans $this->joueurs il y a un joueur avec cette id, si oui je vais return true sinon false
        if($this->joueurs) {
            foreach($this->joueurs as $joueur) {
                if($joueur && $joueur->id && $joueur->id == $joueur_id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function has_joueurs ($joueur_ids) {
        $current_ids = $this->get_ids($this->joueurs);
        $dissociate = array_diff($current_ids, $joueur_ids);
        $associate = array();

        foreach($joueur_ids as $joueur_id) {
            if (!in_array($joueur_id, $current_ids)) {
                array_push($associate, $joueur_id);
            }
        }
        return ["associate" => $associate, "dissociate" => $dissociate];
    }


    public function has_jeu ($jeu_id) {
        //detecter si dans $this->joueurs il y a un joueur avec cette id, si oui je vais return true sinon false
        if($this->jeux) {
            foreach($this->jeu as $jeu) {
                if($jeu && $jeu->id && $jeu->id == $jeu_id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function has_jeux ($jeu_ids) {
        $current_ids = $this->get_ids($this->jeux);
        $dissociate = array_diff($current_ids, $jeu_ids);
        $associate = array();

        foreach($jeu_ids as $jeu_id) {
            if (!in_array($jeu_id, $current_ids)) {
                array_push($associate, $jeu_id);
            }
        }
        return ["associate" => $associate, "dissociate" => $dissociate];
    }







    public function get_ids($objs)
    {
        //renvoyer un tableau d'ID en ayant recu un tableau d'objets
        $ids = array();
        foreach ($objs as $obj) {
            if ($obj->id) {
                array_push($ids, $obj->id);
            }
        }
        return $ids;
    }

}