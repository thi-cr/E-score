<section class="big-container">
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
                        <tr>
                            <?php foreach ($equipe->joueurs as $joueur): ?>
                                <td><?= $joueur->pseudo ?></td>
                            <?php endforeach; ?>
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