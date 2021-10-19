<?php
include_once('./include/entete.php');

if (isset($_GET['id']))
{
    $parameter = 
    [
        'id' => (int) $_GET['id']
    ];

    $client = new SoapClient('http://localhost:1000/UserManager?wsdl');

    $resultat = $client->__soapCall('supprimer', array($parameter));
    echo $resultat->return;

    header('Location: index.php');
}
else
{?>
    <div class="alert alert-danger" role="alert">Erreur de suppression</div><?php
}

include_once('./include/pied.php');
?>