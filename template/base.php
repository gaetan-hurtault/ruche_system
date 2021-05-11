<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script  src="https://code.jquery.com/jquery-3.6.0.js"  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="  crossorigin="anonymous"></script>    
    <script src="https://kit.fontawesome.com/9f32cf0958.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title><?= $pageTitle ?></title>
  </head>
<body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-secondary p-0">
          <span class="navbar-brand p-2">Company</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-md-0 w-100">
                <?php if ($p == 'home') :?>  
                  <li class="nav-item p-2 bg-dark">
                      <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                    <?php else :?>
                  <li class="nav-item p-2">
                      <a class="nav-link" aria-current="page" href="/">Accueil</a>
                    <?php endif ?>
                  </li>
                  <?php if ($p == 'ruche') :?>
                  <li class="nav-item p-2 bg-dark">
                    <a class="nav-link active" href="/?p=ruche">Ruches<span class="badge badge-danger mx-1"><?= $nbrRuche['nb'] ?></span></a>
                    <?php else :?>
                  <li class="nav-item p-2">
                      <a class="nav-link" href="/?p=ruche">Ruches<span class="badge badge-danger mx-1"><?= $nbrRuche['nb'] ?></span></a>
                    <?php endif ?>                   
                  </li>
                     <?php if ($p == 'information') :?>
                    <li class="nav-item p-2 bg-dark">
                      <a class="nav-link active" href="/?p=information">Informations</a>
                    <?php else :?>
                    <li class="nav-item p-2">
                      <a class="nav-link" href="/?p=information">Informations</a>
                    <?php endif ?>
                  </li>
                </ul>
                <span class="nav-item p-2">
                      <a class="nav-link text-light" href="#">Déconnexion</a>
                </span>
              </div>
            </div>
          </nav>
    </header>
    <main class="pt-5">
        <div class="container pt-5">
            <?= $content ?>
        </div>
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>