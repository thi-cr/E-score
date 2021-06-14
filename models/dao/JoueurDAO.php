<?php


class JoueurDAO extends AbstractDAO
{
    public function __construct()
    {
        //appelle le constructeur du parent (AbstractDAO)
        parent::__construct('joueurs');
    }

    public function equipe($joueur_id)
    {
        return $this->belongsTo(new EquipeDAO(), $joueur_id);
    }

    public function create($result)
    {
        return new Joueur(
            $result['id'],
            $result['nom'],
            $result['prenom'],
            $result['pseudo'],
            $result['email'],
            $result['password']
        );
    }

    public function deepCreate($result)
    {
        return new Joueur(
            $result['id'],
            $result['nom'],
            $result['prenom'],
            $result['pseudo'],
            $result['email'],
            $result['password'],
            $this->equipe($result['id'])
        );
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
            $statement = $this->connection->prepare("UPDATE {$this->table} SET nom = ?, prenom = ?, password = ?, pseudo = ?, email = ? WHERE id = ?");
            $statement->execute(
                [
                    htmlspecialchars($data['nom']),
                    htmlspecialchars($data['prenom']),
                    htmlspecialchars($data['password']),
                    htmlspecialchars($data['pseudo']),
                    htmlspecialchars($data['email']),
                    htmlspecialchars($data['id'])
                ]
            );
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function store($id, $data)
    {
        if (empty($data['nom']) || empty($data['prenom']) || empty($data['pseudo']) || empty($data['email']) || empty($data['password'])) {
            return false;
        }

        try {
            $statement = $this->connection->prepare(
                "INSERT INTO {$this->table} (nom, prenom, password, pseudo, email) VALUES (?, ?, ?, ?, ?)"
            );
            $statement->execute([
                htmlspecialchars($data['nom']),
                htmlspecialchars($data['prenom']),
                htmlspecialchars($data['password']),
                htmlspecialchars($data['pseudo']),
                htmlspecialchars($data['email'])
            ]);
            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}