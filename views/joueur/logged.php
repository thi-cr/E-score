<?php var_dump($joueur); ?>
<h3>créer un match</h3>
<form action="/matchs/add">
    <select name="equipe" id="equipe">
        <?php foreach ($equipes as $equipe): ; ?>
            <option type="number" name="equipe_id" value="<?= $equipe->id ?>"><?= $equipe->nom ?></option>
        <?php endforeach;  ?>
    </select>
    <input type="submit" value="Créer un match contre l'equipe sélectionnée">
</form>