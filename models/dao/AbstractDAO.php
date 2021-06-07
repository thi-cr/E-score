<?php

abstract class AbstractDAO {
    protected $connection;
    protected $table;

    public function __construct ($table) {
        $this->table = $table;
        $this->connection = new PDO('mysql:host=localhost;dbname=projet_e-score', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //chercher tous
    public function fetchAll () {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->createAllDeep($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function fetchWhere ($ref, $value) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$ref} = ?");
            $statement->execute([$value]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->createAllDeep($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    //chercher 1
    public function fetch ($id, $deep = true) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if($deep) {
                return $this->deepCreate($result);
            }
            return $this->create($result);

        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetchIntermediate ($table, $id, $key, $foreign) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$table} WHERE {$key} = ?");
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $list = [];
            foreach($result as $item) {
                array_push($list, $this->fetch($item[$foreign], false));
            }
            return $list;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }


    public function createAll ($results) {
        $list = array();
        foreach ($results as $result) {
            array_push($list, $this->create($result));
        }
        return $list;
    }

    //Créer tous avec relations
    public function createAllDeep ($results) {
        $list = array();
        foreach ($results as $result) {
            array_push($list, $this->deepCreate($result));
        }
        return $list;
    }

    //Many to One
    public function belongsTo ($dao, $id) {
        return $dao->fetch($id, false);
    }

    //One to Many
    public function hasMany ($dao, $col, $key) {
        return $dao->fetchWhere($col, $key);
    }

    //Many to Many
    public function belongsToMany ($dao, $table, $id, $key, $foreign) {
        return $dao->fetchIntermediate($table, $id, $key, $foreign);
    }

    public function associate ($table, $id, $key, $ref, $value) {
        try {
            $statement = $this->connection->prepare("INSERT INTO {$table} ({$key}, {$ref}) VALUES (?, ?)");
            $statement->execute([
                $id,
                $value
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function dissociate ($table, $id, $key, $ref, $value) {

        try {
            $statement = $this->connection->prepare("DELETE FROM {$table} WHERE {$key} = ? AND {$ref} = ?");
            $statement->execute([
                $id,
                $value
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function remove ($table, $id, $key) {

        try {
            $statement = $this->connection->prepare("DELETE FROM {$table} WHERE {$key} = ?");
            $statement->execute([
                $id,
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

}