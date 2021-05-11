<?php

if (isset($_GET['f']))
{
    switch ($_GET['f']) {
        case 'nbLines':
            nbInformations();
            break;
        default:
            header('Location:/?p=error');
            break;
    }
}
else
{
    index();
}

function index()
{

    require '../src/connexionbdd.php';

    $limit = 10;
    $pagination = 1;
    $triTarget = "ruche.id";
    $triDirection = "ASC";
    $search = '';

    $sqlRequest = "SELECT * FROM `information_ruche`, `ruche` WHERE `ruche`.`id` = `id_ruche` ";

    /***************GESTION de la pagination et reset des cookies************/
    if (isset($_GET['pagination']))
    {
        $pagination = $_GET['pagination'];
    }
    else if(!(isset($_GET['tri'])) &&
            !(isset($_GET['direction'])) &&
            !(isset($_GET['search'])))
    {
        if (isset($_COOKIE['tri'])) {
            unset($_COOKIE['tri']);
            setcookie('tri', '', time() - 3600, '/');
        }
        if (isset($_COOKIE['direction'])) {
            unset($_COOKIE['direction']);
            setcookie('direction', '', time() - 3600, '/');
        }
        if (isset($_COOKIE['search'])) {
            unset($_COOKIE['search']);
            setcookie('search', '', time() - 3600, '/');
        }
    }
    /****************GESTION recherche ******************/
    if (isset($_GET['search']))
    {
        $search =  $_GET['search'];
        setcookie( "search",  $search, strtotime( '+30 days' ));
    }
    else if(isset($_COOKIE['search']))
    {
        $search = $_COOKIE['search'];
    }

    if ($search != '')
    {
        $sqlRequest .= "AND ( `ruche`.`nom` LIKE '%".$search."%' ";
        $sqlRequest .= "OR `ruche`.`nom` LIKE '%". ucfirst($search)."%' )";
    }
    /***************GESTION du nombre d'information par page**/
    if (isset($_COOKIE['limitInformationPagination']))
    {
        $limit = $_COOKIE['limitInformationPagination'];
    }
    /*********************TRI**************************/
    if (isset($_GET['tri']) && isset($_GET['direction']))
    {
        $triTarget = $_GET['tri'];
        $triDirection = $_GET['direction'];

        setcookie( "tri", $triTarget, strtotime( '+30 days' ));
        setcookie( "direction", $triDirection, strtotime( '+30 days' ));
    }

    if(isset($_COOKIE['tri']) && isset($_COOKIE['direction']))
    {
        $triTarget = $_COOKIE['tri'];
        $triDirection = $_COOKIE['direction'];
    }

    $sqlRequestNb = $sqlRequest;
    $sqlRequest .= 'ORDER BY '. $triTarget .' ' . $triDirection;
    $sqlRequest .= ' LIMIT '.(($pagination-1) * $limit).','.$limit;
    $stmt = $dbh->prepare($sqlRequest);

    try {
        $stmt->execute();
        $informations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }

    $stmt = $dbh->prepare($sqlRequestNb);
    $stmt->execute();
    $nbrInformation = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $nbrInformation = count($nbrInformation);

    require('../template/information/index_information.php');
}

function nbInformations()
{

    if(isset($_POST['nbInformations']))
    {
        setcookie( "limitInformationPagination", $_POST['nbInformations'], strtotime( '+30 days' ));
    }
    header('Location:/?p=information');
}
?>