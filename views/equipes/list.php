<section class="big-container">
    <h3>Liste equipes</h3>
    <section id="erreur">
        <?php if (isset($error)) {
            echo $error;
        }; ?>
    </section>
    <section id="equipes-list">
        <?php if (!empty($equipes)): ?>
            <section id="equipes-list">
                <?php foreach ($equipes as $equipe): ?>
                    <table>
                        <thead>
                        <th><?= $equipe->__get('nom'); ?></th>
                        <th><?= $equipe->__get('tag'); ?></th>
                        </thead>
                        <tbody>
                            <?php foreach ($equipe->joueurs as $joueur): ?>
                            <tr>
                                <td><?= $joueur->pseudo ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
                </tbody>
                </table>
            </section>
        <?php endif; ?>
    </section>
</section>