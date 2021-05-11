<?php if(isset($_GET['success'])): ?>
  <div class="alert alert-success" role="alert">
  <?php switch ($_GET['success']) {
    case '1':
      echo 'Ajout réussi !';
      break;
    case '2':
      echo 'Modification réussi !';
      break;
    case '3':
      echo 'Suppression réussi !';
      break;
    default:
      echo 'success';
      break;
  }
  ?>
  </div>
<?php endif ?>

<div class="d-flex justify-content-between align-items-center">
  <a type="button" class="btn btn-success" href="/?p=ruche&f=add">Ajouter une Ruche</a>
  <form>
    <input type="text" placeholder="Rechercher..." id="search"/>
  </form>
</div>

<table class="table table-striped mt-2">
  <thead>
    <tr>
      <th scope="col d-flex justify-content-between" id="nom">
        Nom 
        <span>
          <a href="/?p=ruche&tri=nom&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
          <a href="/?p=ruche&tri=nom&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
      <th scope="col" id="latitude" >
      Latitude  
        <span>
          <a href="/?p=ruche&tri=latitude&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
          <a href="/?p=ruche&tri=latitude&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
      <th scope="col" id="longitude">
      Longitude  
        <span>
          <a href="/?p=ruche&tri=longitude&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
          <a href="/?p=ruche&tri=longitude&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
      <th scope="col" ></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ruches as $key => $ruche): ?>
    <tr>
      <th scope="row"><?=$ruche['nom']?></th>
      <td><?=$ruche['latitude']?></td>
      <td><?=$ruche['longitude']?></td>
      <td>
          <a href="/?p=ruche&f=modify&id=<?=$ruche['id']?>">Modifier</a> / 
          <a href="/?p=ruche&f=delete&id=<?=$ruche['id']?>">Supprimer</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="d-flex justify-content-between">
  <div>
    Ligne <?php
    echo '<b>'.(($pagination-1) * $limit + 1) . '</b> à <b>' .  (($pagination-1) * $limit + count($ruches)) . '</b> sur <b>' . $nbrRuche . '</b>';
    ?>
    <div class="d-flex align-items-center">
      <form action="/?p=ruche&f=nbLines" method="post" name="form_nbLines" id="form_nbLines">
        <select name="nbLines" class="form-select" id="nbLines">
          <option value="10">10</option>
          <option value="20">20</option>
        </select>
      </form>
      <div class="px-1">
        Lignes
      </div>
    </div>
  </div>
  <?php
    $prec = $pagination == 1 ? 1 : $pagination-1;
    $suiv = $pagination == ceil((intval($nbrRuche) / $limit)) ? $pagination : $pagination+1;
  ?>
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li class="page-item" id="prec">
        <a class="page-link" href="/?p=ruche&pagination=<?= $prec ;?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php for ($i=1; $i < ((intval($nbrRuche) / $limit) + 1); $i++): ?>
        <li class="page-item number"><a class="page-link" href="/?p=ruche&pagination=<?= $i ;?>"><?= $i ;?></a></li>
      <?php endfor; ?>
      <li class="page-item" id="suiv">
        <a class="page-link" href="/?p=ruche&pagination=<?= $suiv ;?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</div>

<script>
  let triTarget = '<?= $triTarget ?>';
  let triDirection = '<?= $triDirection ?>';
  let search = '<?= $search ?>';
  let urlRewrite = ''
/***************NBLINES GESTION******************/
  $('#form_nbLines').change(function()
  {
    $(this).submit();
  });

  $('#form_nbLines option').each(function(){
    
    if($(this).val() == <?=$limit?>)
    {
      $(this).attr('selected','selected');
    }
  });
/***************PAGINATION CSS******************/
  if(<?= $pagination?> == 1)
  {
    $('#prec').addClass('disabled');
  }

  if(<?= $pagination?> == <?= $suiv?>)
  {
    $('#suiv').addClass('disabled');
  }
  
  $('.page-item.number').each(function(){
    if($(this)[0].innerText == <?= $pagination?>)
    {
      $(this).addClass('active');
    }
  });


  /***************GESTION***TRI******************/

  if (triTarget != 'id' && triDirection == "ASC")
  {
    $('#'+triTarget+' i.fa-arrow-up').addClass('text-dark');
  }
  else
  {
    $('#'+triTarget+' i.fa-arrow-down').addClass('text-dark');
  }

  if( triTarget != 'id' && document.location.href.indexOf('tri') == -1)
  {
    urlRewrite += '&tri='+ triTarget +'&direction='+ triDirection;
  }

 /*********************GESTION SEARCH**************/
  $('#search').keypress(function(e)
  {
    if ( e.which == 13 ) {
      event.preventDefault();
      document.location.href += '&search=' + $(this).val();
    }
  });

  if( search != '' && document.location.href.indexOf('search') == -1)
  {
    urlRewrite += '&search=' + search ;
  }
  if(document.location.href.indexOf(urlRewrite) == -1)
  {
    document.location.href += urlRewrite;
  }
</script>

