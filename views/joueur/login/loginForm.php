<button class="loginButton" id="equipes">Equipes</button>
<button class="loginButton" id="matchs">matchs</button>


<form class="formLogin" action="/joueurs/login" method="post">
    <h3>Connexion</h3>
    <label>Pseudo :</label>
    <input type="text" name="pseudo" required>
    <label>mot de passe :</label>
    <input type="password" name="password" required>
    <input type="hidden" name="route" value="<?=$_SERVER['REQUEST_URI']; ?>">
    <input class="btn btn-secondary btn-xl js-scroll-trigger" type="submit" value="s'identifier" name="submit">
</form>


<form class="formLogin" action="/joueurs/register" method="post">
    <h3>Inscription</h3>
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
    <input class="btn btn-secondary btn-xl js-scroll-trigger" type="submit" value="s'inscrire" name="submit">
</form>

<section class="equipes">
</section>
<section class="matchs">
</section>
