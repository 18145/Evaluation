<div class="titreplan">
  <h1>Plan de la belle ville de BOLBEC SA MERE</h1>
</div>
<div class="plan">
  <img src="./assets/img/bolbec.jpg" alt="Plan de Bolbec">
</div>
<div class="contact">
  <h1>Pour nous contacter</h1>
</div>

<?php
if (isset($_POST['frmContact'])) {
  $nom = checkInput($_POST['nom']);
  $prenom = checkInput($_POST['prenom']);
  $mail = checkInput($_POST['mail']);
  $message = checkInput($_POST['msg']);
  $erreur = array();
  if ($nom === "")
    array_push($erreur, "Saisi ton nom");
  if ($prenom === "")
    array_push($erreur, "Saisi ton");
  if ($mail === "")
    array_push($erreur, "Donne moi ton adresse mail");
  if ($message === "")
    array_push($erreur, "Laisse moi un message d'amour");
  if (count($erreur) > 0) {
    $message = '<ul>';
    for($i = 0 ; $i < count($erreur) ; $i++) {
      $message .= '<li>';
      $message .= $erreur[$i];
      $message .= '</li>';
    }
    $message .= '</ul>';
    echo $message;
    require 'frmContact.php';
  }
  else {
    $sqlVerif = "SELECT COUNT(*) FROM eval
    WHERE mail='" . $mail ."'";
    $nbrOccurences = $pdo->query($sqlVerif)->fetchColumn();
    if ($nbrOccurences > 0) {
      echo "Regarde l'echo";
    }
else {
    $sql = "INSERT INTO eval (nom, prenom, mail, msg) VALUES  ('" . $nom . "', '" . $prenom . "', '" . $mail ."', '" . $msg ."')";
    $query = $pdo->prepare($sql);
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':mail', $mail, PDO::PARAM_STR);
    $query->bindValue(':msg', $msg, PDO::PARAM_STR);
    $query->execute();
    echo "Bienvenue dans la secte";
    }
  }
}
else {
  $nom = $prenom = $mail = $msg = "";
  require 'frmContact.php';
}
