<?php if ($equipe): ?>

    <h3>Modification equipe</h3>
    <form action="/equipes/update" method="post">
        <input hidden type="number" name="capitaine_id" value="<?= $equipe->capitaine_id ?>">
        <input hidden type="number" name="id" value="<?= $equipe->id ?>">

        <label>Nom equipe</label>
        <input type="text" name="nom" value="<?= $equipe->nom ?>">

        <label>TAG</label>
        <input type="text" name="tag" value="<?= $equipe->tag ?>">


        <select name="jeux[]" id="jeux" multiple>
            <?php foreach ($jeux as $jeu): ?>

                <option name="jeu_id" value="<?= $jeu->id ?>" <?php if ($equipe->jeux && $equipe->has_jeu($jeu->id)) {
                    echo 'selected';
                } ?>><?= $jeu->nom ?></option>

            <?php endforeach; ?>
        </select>


        <select name="joueurs[]" id="joueurs" multiple>
            <?php foreach ($joueurs as $joueur): ; ?>
                <?php if ($joueur->equipe->id == $equipe->id || $joueur->equipe->id == null): ?>
                    <?php if ($joueur->id != $equipe->capitaine_id): ?>
                        <option name="joueur_id"
                                value="<?= $joueur->id ?>" <?php if ($joueur->equipe->id == $equipe->id) {
                            echo "selected";
                        } ?> ><?= $joueur->pseudo ?></option>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input class="btn btn-secondary btn-xl js-scroll-trigger" type="submit" value="Valider">
    </form>

<?php endif; ?>

