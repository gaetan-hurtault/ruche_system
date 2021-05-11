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

<div class="d-flex justify-content-end align-items-center">
  <form>
    <input type="text" placeholder="Rechercher..."/ id="search">
  </form>
</div>

<table class="table table-striped mt-2">
  <thead>
    <tr>
      <th scope="col" id="nom">
        Ruche
        <span>
          <a href="/?p=information&tri=nom&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
          <a href="/?p=information&tri=nom&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
      <th scope="col" id="date">
        Date
        <span>
          <a href="/?p=information&tri=date&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
          <a href="/?p=information&tri=date&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
      <th scope="col" id="poids">
        Poids
        <span>
            <a href="/?p=information&tri=poids&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
            <a href="/?p=information&tri=poids&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
      <th scope="col" id="temperature">
        Température
        <span>
            <a href="/?p=information&tri=temperature&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
            <a href="/?p=information&tri=temperature&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
      <th scope="col" id="humidite">
        Humidité
        <span>
            <a href="/?p=information&tri=humidite&direction=ASC"><i class="fas fa-arrow-up text-secondary"></i></a> 
            <a href="/?p=information&tri=humidite&direction=DESC"><i class="fas fa-arrow-down text-secondary"></i></a>
        </span>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($informations as $key => $information): ?>
    <tr>
      <td><?=$information['nom']?></th>
      <td><?=date_format(date_create($information['date']),'d-m-Y H:i:s')?></th>
      <td><?=$information['poids']?></th>
      <td><?=$information['temperature']?></td>
      <td><?=$information['humidite']?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="d-flex justify-content-between">
  <div>
    Ligne <?php
    echo '<b>'.(($pagination-1) * $limit + 1) . '</b> à <b>' .  (($pagination-1) * $limit + count($informations)) . '</b> sur <b>' . $nbrInformation. '</b>';
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
    $suiv = $pagination == ceil((intval($nbrInformation) / $limit)) ? $pagination : $pagination+1;
  ?>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item" id="prec">
        <a class="page-link" href="/?p=information&pagination=<?= $prec ;?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php for ($i=1; $i < ((intval($nbrInformation) / $limit) + 1); $i++): ?>
        <li class="page-item number"><a class="page-link" href="/?p=information&pagination=<?= $i ;?>"><?= $i ;?></a></li>
      <?php endfor; ?>
      <li class="page-item" id="suiv">
        <a class="page-link" href="/?p=information&pagination=<?= $suiv ;?>" aria-label="Next">
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

  if (triTarget != 'ruche.id' && triDirection == "ASC")
  {
    $('#'+triTarget+' i.fa-arrow-up').addClass('text-dark');
  }
  else
  {
    $('#'+triTarget+' i.fa-arrow-down').addClass('text-dark');
  }

  if( triTarget != 'ruche.id' && document.location.href.indexOf('tri') == -1)
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

  /***************RELOAD toutes les 30 minutes*********/
  setInterval(function()
  {
    let dt = new Date();

    if(dt.getMinutes() == 0 || dt.getMinutes() == 30)
    {
      location.reload();
    }
  },60000);
</script>



