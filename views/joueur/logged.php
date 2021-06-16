<?php var_dump($joueur); ?>
<?php var_dump($joueur->equipe->id); ?>
<?php if ($joueur->id == $joueur->equipe->capitaine_id): ?>
    <h3>créer un match</h3>
    <form action="/matchs/add" method="post">
        <select name="equipe2" id="equipe2">
            <?php foreach ($equipes as $equipe): ?>
                <?php if ($equipe->id != $joueur->equipe->id): ?>
                    <option type="number" name="equipe2_id" value="<?= $equipe->id ?>"><?= $equipe->nom ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input hidden type="number" name="equipe1" value="<?= $joueur->equipe->id ?>">
        <input type="submit" value="Créer un match contre l'equipe sélectionnée">
    </form>
<?php endif; ?>


<?php if ($joueur->equipe->id == Null): ?>
    <h3>Créer une équipe</h3>
    <form action="/equipes/store" method="post">
        <label>Nom</label>
        <input type="text" name="nom" required>
        <label>TAG</label>
        <input type="text" name="tag" required>
        <label>Joueurs</label>
        <select name="joueurs[]" id="joueurs" multiple>
            <?php foreach ($joueurs as $player): ?>
                <?php if ($player->equipe->id == Null): ?>
                    <option type="number" name="joueur_id" value="<?= $player->id ?>" <?php if($player->id == $joueur->id){echo 'hidden selected';} ?>><?= $player->pseudo ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input hidden type="number" name="capitaine_id" value="<?= $joueur->id ?>">
        <input type="submit" value="Valider">
    </form>

<?php endif; ?>