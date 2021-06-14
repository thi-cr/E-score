<section class="big-container">
    <section id="erreur">
        <?php if (isset($error)) {
            echo $error;
        }; ?>
    </section>
    <section id="matchs-list">
        <?php if (!empty($matchs)): ?>
            <section id="matchs-list">
                <?php foreach ($matchs as $match): ?>
                    <table>
                        <thead>
                        <?php foreach ($equipes as $equipe): ?>
                            <?php if ($equipe->id == $match->equipe1){ echo '<th>'.$equipe->nom.'</th>'; }?>
                        <?php endforeach; ?>
                        <?php foreach ($equipes as $equipe): ?>
                            <?php if ($equipe->id == $match->equipe2){ echo '<th>'.$equipe->nom.'</th>'; }?>
                        <?php endforeach; ?>
                        <?php foreach ($jeux as $jeu): ?>
                            <?php if ($jeu->id == $match->jeu){ echo '<th>'.$jeu->nom.'</th>'; }?>
                        <?php endforeach; ?>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= $match->ScoreEquipe1 ?></td>
                            <td><?= $match->ScoreEquipe2 ?></td>
                        </tr>
                        </tbody>
                    </table>
                <?php endforeach; ?>
                </tbody>
                </table>
            </section>
        <?php endif; ?>
    </section>
</section>
