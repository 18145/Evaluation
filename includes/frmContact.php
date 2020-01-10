<form action="index.php?page=contact" method="post">
  <fieldset>
    <legend>Donne-moi tes données</legend>
  <div>
    <label for="nom">nom :</label>
    <input type="text" name="nom" id="nom" value="<?=$nom ?>"/>
  </div>
  <div>
    <label for="prenom">prénom :</label>
    <input type="text" name="prenom" id="prenom" value="<?=$prenom ?>"/>
  </div>
  <div>
    <label for="mail">mail :</label>
    <input type="email" name="mail" id="mail" value="<?=$mail ?>"/>
  </div>
  </fieldset>
  <fieldset>
  <div>
    <label for="msg">message :</label>
    <textarea name="msg" id="msg"><?=$msg ?></textarea>
  </div>
  <div class="bas">
    <input type="submit" value="Clique-moi grand fou !"/>
  </div>
  </fieldset>
  <input type="hidden" name="frmContact"/>
</form>
