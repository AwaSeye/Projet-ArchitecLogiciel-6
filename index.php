<?php
include_once('./include/entete.php');
?>

<div class="container">
    <br><br>
    <h2>Liste des utilisateurs</h2>
    <br>
    <?php  
        $client = new SoapClient('http://localhost:1000/UserManager?wsdl');
        $resultat = $client->__soapCall('lister', array());

        if (!isset($resultat->return))
        {
            echo "Oupss!! aucun utilisateur enregistré";
        }
        else
        {
    ?>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Login</th>
                <th>Mot de passe</th>
                <th colspan="3">Actions</th>
            </tr><?php
            $utilisateurs = is_array($resultat->return) ? $resultat->return : [$resultat->return];
            foreach ($utilisateurs as $utilisateur)
            {?>
                <tr>
                    <td><?= $utilisateur->id ?></td>
                    <td><?= $utilisateur->nom ?></td>
                    <td><?= $utilisateur->prenom ?></td>
                    <td><?= $utilisateur->login ?></td>
                    <td><?= $utilisateur->password ?></td>
                    <td><a href="./modifier.php?id=<?= $utilisateur->id ?>">Modifier</a></td>
                    <td><a href="./supprimer.php?id=<?= $utilisateur->id ?>">Supprimer</a></td>
                </tr><?php 
            }?>
        </table>
        <?php
        }
    ?>
</div>

<?php
include_once('./include/pied.php');
?>
