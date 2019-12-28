<?php

include_once('Model.php');

if(isset($_POST['submit']))
{
    $model = new Model();

    $resultat =$model->save(
        [
            'prenom' => $_POST['firstname'],
            'nom' => $_POST['lastname'],
            'date_naissance' => $_POST['birthDate'],
            'sexe' => $_POST['sex'],
            'quartier' => $_POST['quartier']
        ]
    );

    $_GET['resultat'] = $resultat;

    header("Location: index.php");
}