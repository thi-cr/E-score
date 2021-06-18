<h1>Bonjour <?= $joueur->pseudo?></h1>
<?php if ($joueur->id == $equipeJoueur->capitaine_id): ?>
    <h3>créer un match</h3>
    <form action="/matchs/add" method="post">
        <select name="equipe2" id="equipe2">
            <?php foreach ($equipes as $equipe): ?>
                <?php if ($equipe->id != $equipeJoueur->id): ?>
                    <option type="number" name="equipe2_id" value="<?= $equipe->id ?>"><?= $equipe->nom ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <label>Jeu</label>
        <select name="jeu" id="jeu">
            <?php foreach ($equipeJoueur->jeux as $jeu): ?>
                <option type="number" name="jeu_id"
                        value="<?= $jeu->id ?>"><?= $jeu->nom ?></option>
            <?php endforeach; ?>
        </select>
        <input hidden type="number" name="equipe1" value="<?= $joueur->equipe->id ?>">
        <input hidden type="number" name="createur" value="<?= $joueur->id ?>">
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
                    <option type="number" name="joueur_id"
                            value="<?= $player->id ?>" <?php if ($player->id == $joueur->id) {
                        echo 'hidden selected';
                    } ?>><?= $player->pseudo ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input hidden type="number" name="capitaine_id" value="<?= $joueur->id ?>">
        <input type="submit" value="Valider">
    </form>

<?php endif; ?>


<?php var_dump($equipeJoueur->capitaine_id) ?>
<?php var_dump($joueur->id) ?>
<h3>Mon equipe</h3>
<section id="equipes-list">
    <section id="equipes-list">
        <table>
            <thead>
            <th><?= $equipeJoueur->__get('nom'); ?></th>
            <th><?= $equipeJoueur->__get('tag'); ?></th>
            </thead>

            <tbody>
            <?php foreach ($equipeJoueur->joueurs as $player): ?>
                <tr>
                    <td><?= $player->pseudo ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
        </tbody>
        <?php if ($joueur->id == $equipeJoueur->capitaine_id): ?>
            <a href="/equipes/edit/<?= $equipeJoueur->id ?>">Modif</a>
        <?php endif; ?>
        </table>
    </section>
</section>


