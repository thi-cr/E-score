<?php


class MatchDAO extends AbstractDAO
{
    public function __construct()
    {
        //appelle le constructeur du parent (AbstractDAO)
        parent::__construct('matchs');
    }

    public function joueurs($match_id)
    {
        return $this->belongsToMany(new JoueurDAO(), 'joueur_match', $match_id, 'match_id', 'joueur_id');
    }

    public function associate_joueurs($id, $joueur_ids, $equipe_id)
    {
        foreach ($joueur_ids as $joueur) {
            $this->associateMatch('joueur_match', $id, 'match_id', 'joueur_id', $joueur, 'equipe_id', $equipe_id);
        }
    }

    public function dissociate_joueurs($id, $joueur_ids)
    {
        foreach ($joueur_ids as $joueur) {
            $this->dissociate('joueur_match', $id, 'match_id', 'joueur_id', $joueur);
        }
    }

    public function remove_joueurs($id){
        $this->remove('joueur_match', $id, 'match_id');
    }


    public function create($result)
    {
        return new Match(
            $result["id"],
            $result["equipe1"],
            $result["equipe2"],
            $result["ScoreEquipe1"],
            $result["ScoreEquipe2"],
            $result["jeu_id"],
            $result["statut"],
            $result["createur_id"],
        );
    }

    public function deepCreate($result)
    {
        return new Match(
            $result["id"],
            $result["equipe1"],
            $result["equipe2"],
            $result["ScoreEquipe1"],
            $result["ScoreEquipe2"],
            $result["jeu_id"],
            $result["statut"],
            $result["createur_id"],
            $this->joueurs($result["id"])
        );
    }


    function store($id, $data)
    {
        if (empty($data['equipe1']) || empty($data['equipe2']) || empty($data['ScoreEquipe1']) || empty($data['ScoreEquipe2']) || empty($data['jeu']) || empty($data['statut']) || empty($data['createur_id'])) {
            return false;
        }
        $MatchDAO = new MatchDAO();

        try {
            $statement = $this->connection->prepare(
                "INSERT INTO {$this->table} (equipe1, equipe2, ScoreEquipe1, ScoreEquipe2, jeu_id, statut, createur_id) VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $statement->execute([
                htmlspecialchars($data['equipe1']),
                htmlspecialchars($data['equipe2']),
                htmlspecialchars($data['ScoreEquipe1']),
                htmlspecialchars($data['ScoreEquipe2']),
                htmlspecialchars($data['jeu']),
                htmlspecialchars($data['statut']),
                htmlspecialchars($data['createur_id']),
            ]);

            $id = $this->connection->lastInsertId();
            if (isset($data['lineup1'])) {
                $MatchDAO->associate_joueurs($id, $data['lineup1'], $data['equipe1']);
            }
            if (isset($data['lineup2'])) {
                $MatchDAO->associate_joueurs($id, $data['lineup2'], $data['equipe2']);
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
            $statement = $this->connection->prepare("UPDATE {$this->table} SET equipe1 = ?, equipe2 = ?, ScoreEquipe1 = ?, ScoreEquipe2 = ?, jeu_id = ?, statut = ?, createur_id = ? WHERE id = ?");
            $statement->execute(
                [
                    htmlspecialchars($data['equipe1']),
                    htmlspecialchars($data['equipe2']),
                    htmlspecialchars($data['ScoreEquipe1']),
                    htmlspecialchars($data['ScoreEquipe2']),
                    htmlspecialchars($data['jeu']),
                    htmlspecialchars($data['statut']),
                    htmlspecialchars($data['createur_id']),
                    htmlspecialchars($data['id'])
                ]
            );
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        $match = $this->fetch($data['id']);
        $MatchDAO = new MatchDAO();

        if (isset($data['lineup1'])) {
            $diff = $match->has_joueurs($data['lineup1']);

            if ($diff['associate']) {
                $MatchDAO->associate_joueurs($data['id'], $diff['associate'], $data['equipe1']);
            }

            if ($diff['dissociate']) {
                $MatchDAO->dissociate_joueurs($data['id'], $diff['dissociate']);
            }
        }

        if (isset($data['lineup2'])) {
            $diff = $match->has_joueurs($data['lineup2']);

            if ($diff['associate']) {
                $MatchDAO->associate_joueurs($data['id'], $diff['associate'], $data['equipe2']);
            }

            if ($diff['dissociate']) {
                $MatchDAO->dissociate_joueurs($data['id'], $diff['dissociate']);
            }
        }
    }

}