<?php require 'header.php'; ?>
<h1>Pour nous contacter</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<?php require 'footer.php'; ?

if (isset($_POST['frmContact'])) {
  $nom = checkInput($_POST['nom']);
  $prenom = checkInput($_POST['prenom']);
  $mail = checkInput($_POST['mail']);
  $msg = checkInput($_POST['msg']);

  $erreur = array();

  if ($nom === "")
    array_push($erreur, "Veuillez saisir votre nom");

  if ($prenom === "")
    array_push($erreur, "Veuillez saisir un prénom");

  if ($mail === "")
    array_push($erreur, "Veuillez saisir une adresse mail");

  if ($msg === "")
    array_push($erreur, "Veuillez saisir un message");

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
    $sqlVerif = "SELECT COUNT(*) FROM clients
    WHERE mail='" . $mail ."'";
    $nbrOccurences = $pdo->query($sqlVerif)->fetchColumn();

    if ($nbrOccurences > 0) {
      echo "Déjà dans la base";
    }

    else {

        $sql = "INSERT INTO clients
        (nom, prenom, mail, message)
        VALUES ('" . $nom . "', '" . $prenom . "', '" . $mail ."', '" . $msg ."')";

        $query = $pdo->prepare($sql);
        $query->bindValue('nom', $nom, PDO::PARAM_STR);
        $query->bindValue('prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue('mail', $mail, PDO::PARAM_STR);
        $query->bindValue('message', $msg, PDO::PARAM_STR);

        $query->execute();

        echo "Enregistrement OK";
      }
  }
}

else {
  $nom = $prenom = $mail = $msg = "";
  require 'frmContact.php';
}
