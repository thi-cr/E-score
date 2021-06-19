<section>
    <form action="/matchs/store" method="post">
        <input hidden type="number" name="equipe1" value="<?= $equipe1->id ?>">
        <input hidden type="number" name="equipe2" value="<?= $equipe2->id ?>">
        <label>Score <?= $equipe1->nom ?></label>
        <input type="number" name="ScoreEquipe1" value="0" required>
        <br><label>Score <?= $equipe2->nom ?></label>
        <input type="number" name="ScoreEquipe2" value="0" required>
        <input hidden type="number" name="jeu" value="<?= $jeu->id ?>">
        <br><label>Statut</label>
        <select name="statut" required>
            <option type="text" value="Terminé">Terminé</option>
            <option type="text" value="à venir">à venir</option>
        </select>
        <input hidden type="number" name="createur_id" value="<?= $createur->id ?>">
        <br><label>Lineup <?= $equipe1->nom ?></label>
        <select name="lineup1[]" id="lineup1" multiple>
            <?php foreach ($lineup1 as $joueur): ?>
                <option name="joueur1_id" value="<?= $joueur->id ?>"><?= $joueur->pseudo ?></option>
            <?php endforeach; ?>
        </select>
        <br><label>Lineup <?= $equipe2->nom ?></label>
        <select name="lineup2[]" id="lineup2" multiple>
            <?php foreach ($lineup2 as $joueur): ?>
                <option name="joueur2_id" value="<?= $joueur->id ?>"><?= $joueur->pseudo ?></option>
            <?php endforeach; ?>
        </select>
        <input class="btn btn-secondary btn-xl js-scroll-trigger" type="submit" value="créer le match">
    </form>
</section>

