<section class="big-container">
    <h3>Liste matchs</h3>
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
                        <?php for ($i = 0; $i < count($match->lineup1); $i++): ?>
                            <tr>
                                <td><?php if (isset($match->lineup1[$i])) {
                                        echo $match->lineup1[$i]->pseudo;
                                    } ?></td>
                                <td><?php if (isset($match->lineup2[$i])) {
                                        echo $match->lineup2[$i]->pseudo;
                                    } ?></td>
                            </tr>
                        <?php endfor; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
                </tbody>
                </table>
            </section>
        <?php endif; ?>
    </section>
</section>
