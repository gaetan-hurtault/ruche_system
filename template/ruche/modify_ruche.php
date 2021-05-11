
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
        default:
          echo 'error';
          break;
      }?>
    </div>
  <?php endif ?>

  <form name="modify_ruche" action="" method="post">
    <input type="hidden" name="id" id="id" value="<?=$value['id'] ?>">
    <div class="form-group">
      <label for="nom_ruche">Nom :</label>
      <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisisez le nom de la ruche" value="<?=$value['nom'] ?>" required>
    </div>
    <div class="form-group">
      <label for="longitude">Longitude</label>
      <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Saisisez la longitude" value="<?=$value['longitude'] ?>" required>
    </div>
    <div class="form-group">
      <label for="latitude">Latitude</label>
      <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Saisisez la longitude" value="<?=$value['latitude'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Envoyez</button>
  </form>
