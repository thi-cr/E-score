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

    public function associate_joueurs($id, $joueur_ids)
    {
        foreach ($joueur_ids as $joueur) {
            $this->associateUpdate('joueurs', $id, 'equipe_id', 'joueur_id', $joueur);
        }
    }

    public function dissociate_joueurs($id, $joueur_ids)
    {
        foreach ($joueur_ids as $joueur) {
            $this->dissociateUpdate('joueurs', $id, 'equipe_id', 'joueur_id', $joueur);
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
            if (isset($data['joueurs'])) {
                $id = $this->connection->lastInsertId();
                $EquipeDAO->associate_joueurs($id, $data['joueurs']);
                return true;
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
        } else {
            $EquipeDAO->remove_joueurs($data['id']);
        }

    }
}