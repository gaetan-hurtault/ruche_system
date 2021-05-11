
  <?php if(isset($_GET['error'])): ?> 
    <div class="alert alert-danger" role="alert">
      <?php switch ($_GET['error']) {
        case '1':
          echo 'longitude incorrecte';
          break;
        case '2':
          echo 'latitude incorrecte';
          break;
        case '3':
          echo 'nom incorrect';
          break;
        case '4':
          echo 'nom déjà pris';
          break;
        default:
          echo 'error';
          break;
      }?>
    </div>
  <?php endif ?>

  <form name="add_ruche" action="" method="post">
    <div class="form-group">
      <label for="nom_ruche">Nom :</label>
      <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisisez le nom de la ruche" required>
    </div>
    <div class="form-group">
      <label for="longitude">Longitude</label>
      <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Saisisez la longitude" required>
    </div>
    <div class="form-group">
      <label for="latitude">Latitude</label>
      <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Saisisez la longitude" required>
    </div>
    <button type="submit" class="btn btn-primary">Envoyez</button>
  </form>
