<?php if ($equipe): ?>
    <?php var_dump($equipe);?>

    <form action="/equipes/update" method="post">
        <input hidden type="number" name="capitaine_id" value="<?= $equipe->capitaine_id ?>">
        <input hidden type="number" name="id" value="<?= $equipe->id ?>">

        <label>Nom equipe</label>
        <input type="text" name="nom" value="<?= $equipe->nom ?>">

        <label>TAG</label>
        <input type="text" name="tag" value="<?= $equipe->tag ?>">



        <select name="joueurs[]" id="joueurs" multiple>
            <?php foreach ($joueurs as $joueur): ; ?>
                <?php if ($joueur->equipe->id == $equipe->id || $joueur->equipe->id == null): ?>
                    <option name="joueur_id" value="<?= $joueur->id ?>" <?php if ($joueur->equipe->id == $equipe->id) {
                        echo "selected";} ?>><?= $joueur->pseudo ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Valider">
    </form>

<?php endif; ?>