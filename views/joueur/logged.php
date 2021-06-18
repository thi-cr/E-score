<h1>Bonjour <?= $joueur->pseudo ?></h1>
<?php if ($joueur->id == $equipeJoueur->capitaine_id): ?>
    <h3>créer un match</h3>
    <form action="/matchs/add" method="post">
        <select name="equipe2" id="equipe2">
            <?php foreach ($equipes as $team): ?>
                <?php if ($team->id != $equipeJoueur->id): ?>
                    <option type="number" name="equipe2_id" value="<?= $team->id ?>"><?= $team->nom ?></option>
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

<h3>Matchs</h3>
<section id="matchs_list">
    <?php foreach ($equipeJoueur->matchs as $match): ?>
        <table>
            <thead>
            <?php foreach ($equipes as $equipe): ?>
                <?php if ($equipe->id == $match->equipe1): ?>
                    <th><?= $equipe->nom . ' ' . $match->ScoreEquipe1 ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php foreach ($equipes as $equipe): ?>
                <?php if ($equipe->id == $match->equipe2): ?>
                    <th><?= $equipe->nom . ' ' . $match->ScoreEquipe2 ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($match->lineup1) ; $i++): ?>
                <tr>
                    <td><?php if (isset($match->lineup1[$i])){echo $match->lineup1[$i]->pseudo;}?></td>
                    <td><?php if (isset($match->lineup2[$i])){echo $match->lineup2[$i]->pseudo;}?></td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
        <?php if ($joueur->id == $equipeJoueur->capitaine_id): ?>
            <a href="/matchs/edit/<?= $equipeJoueur->id ?>">Modif</a>
        <?php endif; ?>
    <?php endforeach; ?>
</section>