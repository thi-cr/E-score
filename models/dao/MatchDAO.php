<?php


class MatchDAO extends AbstractDAO
{
    public function __construct()
    {
        //appelle le constructeur du parent (AbstractDAO)
        parent::__construct('matchs');
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
            $result["createur_id"]
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
            $result["createur_id"]
        );
    }


    function store($id, $data)
    {
        if (empty($data['equipe1']) || empty($data['equipe2']) || empty($data['ScoreEquipe1']) || empty($data['ScoreEquipe2']) || empty($data['jeu']) || empty($data['statut']) || empty($data['createur_id'])) {
            return false;
        }

        try {
            $statement = $this->connection->prepare(
                "INSERT INTO {$this->table} (equipe1, equipe2, , pseudo, email) VALUES (?, ?, ?, ?, ?)"
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
    }

}