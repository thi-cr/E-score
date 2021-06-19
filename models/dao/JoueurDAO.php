<?php


class JoueurDAO extends AbstractDAO
{
    public function __construct()
    {
        //appelle le constructeur du parent (AbstractDAO)
        parent::__construct('joueurs');
    }

    public function equipe($equipe_id)
    {
        return $this->belongsTo(new EquipeDAO(), $equipe_id);
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
            $this->equipe($result['equipe_id'])
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

        $joueurDAO = new JoueurDAO();

        $joueur = $this->create(
            [
                'id' => 0,
                'nom' =>$data['nom'],
                'prenom' =>$data['prenom'],
                'password' => password_hash($data['password'],PASSWORD_DEFAULT),
                'pseudo' =>$data['pseudo'],
                'email' =>$data['email'],
            ]
        );

        try {
            $statement = $this->connection->prepare(
                "INSERT INTO {$this->table} (nom, prenom, password, pseudo, email) VALUES (?, ?, ?, ?, ?)"
            );
            $statement->execute([
                htmlspecialchars($joueur->nom),
                htmlspecialchars($joueur->prenom),
                htmlspecialchars($joueur->password),
                htmlspecialchars($joueur->pseudo),
                htmlspecialchars($joueur->email)
            ]);
            return true;
        } catch (PDOException $e) {
            //print $e->getMessage();
            $msg = 'Pseudo ou email deja utilisé';
            print $msg;
        }
    }
    // vérifie si user en db ? si oui il le renvoie et on check le mdp
    public function verify($data){
        if (empty($data['pseudo']) || empty($data['password'])){
            return false;
        }
        try {
            $statement = $this->connection->prepare("select * from {$this->table} where pseudo = ? ");
            $statement->execute([
                $data['pseudo']
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $joueur = $this->create($result);
            if($joueur){
                if(password_verify($data['password'], $joueur->password)) {
                    //var_dump('user ok');
                    $joueur = $this->setToken($joueur);
                    return $joueur;
                }
            }
            var_dump('mdp incorrect');
            return false;
        }catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }


    public function setToken($joueur) {
        //générer un token
        $token = bin2hex(random_bytes(8)) . "." . time();
        $joueur->session_token = $token;
        date_default_timezone_set('Europe/Brussels');
        $joueur->session_time = date("Y-m-d H:i:s");
        //echo time();
        //créer un cookie avec le token : clé,valeur,durée,domaine dispo : / --> racine
        setcookie('session_token', $token, time()+60*60*24, "/");

        //update l'utilisateur en DB avec son nouveau token
        $this->updateToken($joueur);
        return $joueur;
    }

    public function updateToken ($joueur) {
        try {
            $statement = $this->connection->prepare("UPDATE {$this->table} SET session_token = ?, session_time = ? WHERE id = ?");
            $statement->execute([
                $joueur->session_token,
                $joueur->session_time,
                $joueur->id
            ]);
            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

    public function fetchBySession($session_token) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE session_token = ?");
            $statement->execute([$session_token]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->deepCreate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

}