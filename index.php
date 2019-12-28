
<?php 
include_once('Model.php');
$model = new Model();
$quartiers = $model->getQuartiers();
sort($quartiers);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checkout example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="logo.png" alt="" width="72" height="72">
        <h2>Formulaire d'enregistrement</h2>
        <p class="lead">Renseignez vos informations dans le formulaire ci-dessous</p>
      </div>
      <div class="row">
      <div class="col-xs-12 col-md-6 offset-3">
        <form action="save.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Prénom</label>
                    <input type="text" class="form-control" name="firstname"  placeholder="Entrez votre prénom" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nom</label>
                    <input type="text" class="form-control" name="lastname" required placeholder="Entrez votre nom">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Date de naissance</label>
                    <input type="date" class="form-control" name="birthDate" required  placeholder="Entrez votre nom">
                </div>
                <div class="form-group">
                    <label for="sexe">Sexe &nbsp;</label>
                    <select name="sex" class="form-control">
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quartier">Quartier d'habitation &nbsp;</label>
                    <select name="quartier" class="form-control" required>
                        <?php 
                        
                        foreach($quartiers as $q)
                        { ?>
                            <option value="<?php echo $q ?>"><?php echo $q;?></option>
                        <?php } ?>
                    </select>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Soumettre"/>
        </form>
        </div>
      </div>

    </div>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <script src="jquery-3.3.1.min.js"></script>
    <script src="gijgo.min.js" type="text/javascript"></script>
  </body>
</html>
