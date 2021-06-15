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
            print $e->getMessage();
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
                    var_dump('user ok');
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

    function fetchBySession(){
    }

}