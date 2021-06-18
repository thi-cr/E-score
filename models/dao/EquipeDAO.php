<?php


class EquipeDAO extends AbstractDAO
{
    public function __construct()
    {
        //appelle le constructeur du parent (AbstractDAO)
        parent::__construct('equipes');
    }

    public function joueurs($equipe_id)
    {
        return $this->hasMany(new JoueurDAO(), 'equipe_id', $equipe_id);
    }

    public function matchs($equipe_id)
    {
        $un = $this->hasMany(new MatchDAO(), 'equipe1', $equipe_id);
        $deux = $this->hasMany(new MatchDAO(), 'equipe2', $equipe_id);
        return array_merge_recursive($un, $deux);
    }

    public function jeux($equipe_id)
    {
        return $this->belongsToMany(new JeuDAO(), 'equipe_jeu', $equipe_id, 'equipe_id', 'jeu_id');
    }

    public function associate_jeux($id, $jeux_ids)
    {
        foreach ($jeux_ids as $jeu) {
            $this->associate('equipe_jeu', $id, 'equipe_id', 'jeu_id', $jeu);
        }
    }

    public function dissociate_jeux($id, $jeux_ids)
    {
        foreach ($jeux_ids as $jeu) {
            $this->dissociate('equipe_jeu', $id, 'equipe_id', 'jeu_id', $jeu);
        }
    }


    public function associate_joueurs($id, $joueur_ids)
    {
        foreach ($joueur_ids as $joueur) {
            $this->associateUpdate('joueurs', $id, 'equipe_id', 'id', $joueur);
        }
    }

    public function dissociate_joueurs($id, $joueur_ids)
    {
        foreach ($joueur_ids as $joueur) {
            $this->dissociateUpdate('joueurs', $id, 'equipe_id', 'id', $joueur);
        }
    }

    public function remove_joueurs($id)
    {
        $this->remove('joueurs', $id, 'equipe_id');
    }

    public function create($result)
    {
        return new Equipe(
            $result["id"],
            $result["nom"],
            $result["tag"],
            $result["capitaine_id"]
        );
    }

    public function deepCreate($result)
    {
        return new Equipe(
            $result["id"],
            $result["nom"],
            $result["tag"],
            $result["capitaine_id"],
            $this->joueurs($result["id"]),
            $this->jeux($result["id"]),
            $this->matchs($result["id"])
        );
    }

    function store($id, $data)
    {
        if (empty($data['nom']) || empty($data['tag']) || empty($data['capitaine_id'])) {
            return false;
        }
        $data['joueurs'][] = $data["capitaine_id"];
        $EquipeDAO = new EquipeDAO();
        $equipe = $this->create(
            [
                'id' => 0,
                'nom' => $data['nom'],
                'tag' => $data['tag'],
                'capitaine_id' => $data['capitaine_id']
            ]
        );

        try {
            $statement = $this->connection->prepare(
                "INSERT INTO {$this->table} (nom, tag, capitaine_id) VALUES (?, ?, ?)"
            );
            $statement->execute([
                htmlspecialchars($data['nom']),
                htmlspecialchars($data['tag']),
                htmlspecialchars($data['capitaine_id'])

            ]);
            $id = $this->connection->lastInsertId();
            if (isset($data['joueurs'])) {
                $EquipeDAO->associate_joueurs($id, $data['joueurs']);
            }
            if (isset($data['jeux'])) {
                $EquipeDAO->associate_jeux($id, $data['jeux']);
            }
            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
        }


    }

    function delete($data)
    {
        if (empty($data['id'])) {
            return false;
        }

        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $statement->execute([
                $data['id']
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    public function update($id, $data)
    {
        $data['joueurs'][] = $data["capitaine_id"];
        try {
            $statement = $this->connection->prepare("UPDATE {$this->table} SET nom = ?, tag = ?, capitaine_id = ? WHERE id = ?");
            $statement->execute(
                [
                    htmlspecialchars($data['nom']),
                    htmlspecialchars($data['tag']),
                    htmlspecialchars($data['capitaine_id']),
                    htmlspecialchars($data['id']),
                ]
            );
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        $equipe = $this->fetch($data['id']);
        $EquipeDAO = new EquipeDAO();

        if (isset($data['joueurs'])) {
            $diff = $equipe->has_joueurs($data['joueurs']);

            if ($diff['associate']) {
                $EquipeDAO->associate_joueurs($data['id'], $diff['associate']);
            }

            if ($diff['dissociate']) {
                $EquipeDAO->dissociate_joueurs($data['id'], $diff['dissociate']);
            }
        }

        if (isset($data['jeux'])) {
            $diff = $equipe->has_jeux($data['jeux']);

            if ($diff['associate']) {
                $EquipeDAO->associate_jeux($data['id'], $diff['associate']);
            }

            if ($diff['dissociate']) {
                $EquipeDAO->dissociate_jeux($data['id'], $diff['dissociate']);
            }
        }


    }
}