<form action="/matchs/update" method="post">
    <label>Jeu</label>
    <select name="jeu" id="jeu">
        <?php foreach ($equipe1->jeux as $jeu): ?>
            <option name="jeu_id" value="<?= $jeu->id ?>" <?php if ($jeu->id == $match->jeu) {
                echo 'selected';
            } ?>><?= $jeu->nom ?></option>
        <?php endforeach; ?>
    </select>
    <br><label>Score equipe 1</label>
    <input type="number" name="ScoreEquipe1" value="<?= $match->ScoreEquipe1 ?>">
    <label>Score equipe 2</label>
    <input type="number" name="ScoreEquipe2" value="<?= $match->ScoreEquipe2 ?>">
    <br><label>Lineup <?= $equipe1->nom ?></label>
    <select name="new_lineup1[]" id="lineup1" multiple>
        <?php foreach ($lineup1 as $joueur): ?>
            <option name="joueur1_id" value="<?= $joueur->id ?>"><?= $joueur->pseudo ?></option>
        <?php endforeach; ?>
    </select>
    <br><label>Lineup <?= $equipe2->nom ?></label>
    <select name="new_lineup2[]" id="lineup2" multiple>
        <?php foreach ($lineup2 as $joueur): ?>
            <option name="joueur2_id" value="<?= $joueur->id ?>"><?= $joueur->pseudo ?></option>
        <?php endforeach; ?>
    </select>
    <br><label>Statut</label>
    <select name="statut" required>
        <option type="text" value="Terminé" <?php if ($match->statut == 'Terminé') {
            echo 'selected';
        } ?>>Terminé
        </option>
        <option type="text" value="à venir" <?php if ($match->statut == 'à venir') {
            echo 'selected';
        } ?>>à venir
        </option>
    </select>
    <input type="number" name="equipe1" value="<?= $match->equipe1 ?>" hidden>
    <input type="number" name="equipe2" value="<?= $match->equipe2 ?>" hidden>
    <input type="number" name="id" value="<?= $match->id ?>" hidden>
    <input type="number" name="createur_id" value="<?= $match->createur_id ?>" hidden>
    <input type="submit" value="Valider">
</form>
