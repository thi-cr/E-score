
<a href="/equipes/index">equipes</a>
<a href="/matchs/index">matchs</a>

<h3>Connexion</h3>
<form action="/joueurs/login" method="post">
    <label>Pseudo :</label>
    <input type="text" name="pseudo" required>
    <label>mot de passe :</label>
    <input type="password" name="password" required>
    <input type="hidden" name="route" value="<?=$_SERVER['REQUEST_URI']; ?>">
    <input type="submit" value="s'identifier" name="submit">
</form>

<h3>Inscription</h3>
<form action="/joueurs/register" method="post">

    <label>Nom :</label>
    <input type="text" name="nom" required>
    <br><label>Prénom :</label>
    <input type="text" name="prenom" required>
    <br><label>mot de passe :</label>
    <input type="password" name="password" required>
    <br><label>pseudo :</label>
    <input type="text" name="pseudo" required>
    <br><label>email :</label>
    <input type="email" name="email" required>
    <input type="submit" value="s'inscrire" name="submit">
</form>


