<?php
include_once('./include/entete.php');
?>

<div class="container">

    <?php
    $client = new SoapClient('http://localhost:1000/UserManager?wsdl');
    $resultat = $client->__soapCall('lister', array());

    foreach ($resultat->return as $utilisateur)
    {
        if($utilisateur->id == $_GET['id'])
        {
            if (!isset($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['password'], $_POST['password2']))
            {?>
                <form action="" method="post"><br>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="texte" name="nom" class="form-control" id="nom" placeholder="Entrer nom" value="<?php echo $utilisateur->nom ?>">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom:</label>
                        <input type="texte" name="prenom" class="form-control" id="prenom" placeholder="Entrer prenom" value="<?php echo $utilisateur->prenom ?>">
                    </div>
                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input type="texte" name="login" class="form-control" id="login" placeholder="Entrer login" value="<?php echo $utilisateur->login?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Entrer mot de passe" >
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirmation mot de passe:</label>
                        <input type="password" name="password2" class="form-control" id="password2" placeholder="Confirmer mot de passe" >
                    </div>
                    
                    <div align="center">
                        <input type="submit" name="formInscription" class="btn btn-primary" value="Modifier">
                    </div>
                </form><br><?php
            }
            else
            {
                $id = (int) $_GET['id'];
                $nom = htmlentities($_POST['nom']);
                $prenom = htmlentities($_POST['prenom']);
                $login = htmlentities($_POST['login']);
                $password = htmlentities($_POST['password']);
                $password2 = htmlentities($_POST['password2']);

                $parameters =
                [
                    'id' => $id,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'login' => $login,
                    'password' => $password,
                    'password2' => $password2
                ];

                $client = new SoapClient('http://localhost:1000/UserManager?wsdl');
                if (!empty($nom) && !empty($prenom) && !empty($login) && !empty($password) && !empty($password2))
                {
                    $loginlength = strlen($login);
                    if ($loginlength <= 255)
                    {
                        if ($password == $password2)
                        {
                            $resultat = $client->__soapCall('modifier', array($parameters));
                            echo $resultat->return;
                            header('Location: index.php');
                        }
                        else
                        {
                            $erreur = "Vos mots de passe ne correspondent pas !!!";
                        }
                    }
                    else
                    {
                        $erreur = "Votre Login ne doit pas depasser 255 caracteres !!!";
                    }
                }
                else
                {
                    $erreur = "Tous les champs doivent etre remplis !!";
                }       

            }
        }
    }
    ?>
</div>
<?php
if (isset($erreur))
{
    echo '<font color="red" class="alert alert-danger" role="alert">'.$erreur."</font>";
}
?>

<?php
include_once('./include/pied.php');
?>



