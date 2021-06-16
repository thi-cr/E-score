<?php var_dump($joueur); ?>
<?php var_dump($joueur->equipe->id); ?>
<?php if ($joueur->id == $joueur->equipe->capitaine_id): ?>
    <h3>créer un match</h3>
    <form action="/matchs/add">
        <select name="equipe" id="equipe">
            <?php foreach ($equipes as $equipe): ?>
                <?php if ($equipe->id != $joueur->equipe->id): ?>
                    <?php var_dump($equipes); ?>
                    <option type="number" name="equipe_id" value="<?= $equipe->id ?>"><?= $equipe->nom ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Créer un match contre l'equipe sélectionnée">
    </form>
<?php endif; ?>