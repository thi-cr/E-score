<?php var_dump($joueur); ?>
<h3>créer un match</h3>
<form action="/matchs/add">
    <? var_dump($equipes)?>
    <select name="equipe" id="equipe">
        <?php foreach ($equipes as $equipe): ; ?>
        <?php if ($equipe->id != $joueur->equipe->id): ?>
            <option type="number" name="equipe_id" value="<?= $equipe->id ?>"><?= $equipe->nom ?></option>
        <?php endif; ?>
        <?php endforeach;  ?>
    </select>
    <input type="submit" value="Créer un match contre l'equipe sélectionnée">
</form>