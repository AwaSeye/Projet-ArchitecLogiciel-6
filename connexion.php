<?php
require_once('./include/enteteConnexion.php');
?>

<div class="container">
    <?php
    if (isset($_POST['formConnexion']))
    {
        $loginConnect = htmlspecialchars($_POST['loginConnect']);
        $passwordConnect = $_POST['passwordConnect'];
        
        if (!empty($loginConnect) && !empty($passwordConnect))
        {
            $client = new SoapClient('http://localhost:1000/UserManager?wsdl');
            $resultat = $client->__soapCall('lister', array());

            foreach ($resultat->return as $utilisateur)
            {
                $loginExistant = $utilisateur->login;
                $passwordExistant = $utilisateur->password;   
                if ($loginExistant == $loginConnect && $passwordExistant == $passwordConnect)
                {
                    header("Location: index.php");
                }
                else
                {
                   $erreur = "Mauvais mail ou mot de passe !";
                }
            }
        }
        else
        {
            $erreur = "Tous les champs doivent etre remplis !!";
        }
    }
    ?>

    <form action="" method="post"><br>
        <fieldset><br>
            <legend><center>Connexion</center></legend>
            <div class="form-group">
                <input type="text" name="loginConnect" class="form-control" id="loginConnect" placeholder="Entrer Login" value="<?php if (isset($loginConnect)) { echo $loginConnect ; } ?>">
            </div>
            <div class="form-group">
                <input type="password" name="passwordConnect" class="form-control" id="password" placeholder="Entrer mot de passe">
            </div>
            <div align="center">
                 <input type="submit" name="formConnexion" class="btn btn-primary" value="Se connecter">
            </div>
        </fieldset>
        <?php 
        if (isset($erreur))
        {
            echo '<font color="red" class="alert alert-danger" role="alert">'.$erreur."</font>";
        }?>
    </form><br>
</div>

<?php
include_once('./include/pied.php');
?>