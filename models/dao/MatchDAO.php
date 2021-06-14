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
            $result["jeu"],
            $result["statut"],
            $result["idCreateur"]
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
            $result["jeu"],
            $result["statut"],
            $result["idCreateur"]
        );
    }

}