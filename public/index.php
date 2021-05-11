<?php
require '../src/connexionbdd.php';

$stmt = $dbh->prepare("SELECT count(id) as nb FROM `ruche`");
$stmt->execute();
$nbrRuche = $stmt->fetch();

if (isset($_GET['p'])) {
	$p = $_GET['p'];
}
else
{
	$p = 'home';
}

ob_start();

switch ($p) {
	case 'home':
        require '../template/page/home.php';
        break;
	case 'ruche':
        $pageTitle = "Les Ruches";
		require '../src/controller/ruche.php';
		break;
	case 'information':
        $pageTitle = "Informations";
		require '../src/controller/information.php';
		break;
    default :
        require '../template/error/error404.php';
        break;
}

$content = ob_get_clean();

require '../template/base.php';