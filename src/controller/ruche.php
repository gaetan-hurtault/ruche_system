<?php

if (isset($_GET['f']))
{
    switch ($_GET['f']) {
        case 'add':
            add();
            break;
        case 'modify':
            modify();
            break;
        case 'delete':
            suppr();
            break;
        case 'nbLines':
            nbLines();
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
    $triTarget = "id";
    $triDirection = "ASC";
    $search = "";

    $sqlRequest = "SELECT * FROM `ruche`";
    
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
        $sqlRequest .= "WHERE `nom` LIKE '%".$search."%' ";
        $sqlRequest .= "OR `nom` LIKE '%". ucfirst($search)."%' ";
    }
    /***************GESTION du nombre de ruche par page**/
    if (isset($_COOKIE['limitRuchePagination']))
    {
        $limit = $_COOKIE['limitRuchePagination'];
    }
    /*********************TRI**************************/
    if (isset($_GET['tri']) && isset($_GET['direction']))
    {
        $triTarget = $_GET['tri'];
        $triDirection = $_GET['direction'];

        setcookie( "tri", $triTarget, strtotime( '+30 days' ));
        setcookie( "direction", $triDirection, strtotime( '+30 days' ));
    }
    else if(isset($_COOKIE['tri']) && isset($_COOKIE['direction']))
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
        $ruches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }

    $stmt = $dbh->prepare($sqlRequestNb);
    $stmt->execute();
    $nbrRuche = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $nbrRuche = count($nbrRuche);

    require('../template/ruche/index_ruche.php');
}

function add()
{
    require '../src/connexionbdd.php';

    if (isset($_POST['longitude']))
    {
        /****Verification de la longitude, si elle est saisi et si elle correspond au format*/
        if (!((isset($_POST['longitude'])) 
        && 
        (preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/', $_POST['longitude']))
        ))
        {
            header('Location:/?p=ruche&f=add&error=1');
            exit;
        }
        /****Verification de la latitude, si elle est saisi et si elle correspond au format*/
        if (!((isset($_POST['latitude'])) 
        && 
        preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/', $_POST['latitude'])
        ))
        {
            header('Location:/?p=ruche&f=add&error=2');
            exit;
        }
        /****Verification du nom, s'il est saisi*/
        if (!(isset($_POST['nom'])) || $_POST['nom'] == "") 
        {
            header('Location:/?p=ruche&f=add&error=3');
            exit;
        }
        /*******Nettoyage du nom*********************/
        $nom = ucfirst(trim(
            strip_tags(
                $_POST['nom']
                )
            ));

        /****Verification du nom, s'il est déjà pris*/
        $stmt = $dbh->prepare("SELECT * FROM `ruche` WHERE `nom` = :nom");
        $stmt->bindValue(':nom',$nom);
        $stmt->execute();
        $nomVerif = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($nomVerif != null)
        {
            header('Location:/?p=ruche&f=add&error=4');
            exit;
        }


        $stmt = $dbh->prepare("INSERT INTO `ruche` (`nom`, `longitude`, `latitude`) VALUES (:nom,:longitude,:latitude)");
        $stmt->bindValue(':nom',$nom);
        $stmt->bindValue(':longitude',$_POST['longitude']);
        $stmt->bindValue(':latitude',$_POST['latitude']);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            header('Location:/?p=ruche&f=add');
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
            exit;
        }

        header('Location:/?p=ruche&success=1');
        exit;
    }
    else
    {
        require('../template/ruche/add_ruche.php');
    }
}

function modify()
{
    require '../src/connexionbdd.php';
    
    if (isset($_POST['longitude']))
    {
        /****Verification de la longitude, si elle est saisi et si elle correspond au format*/
        if (!((isset($_POST['longitude'])) 
        && 
        (preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/', $_POST['longitude']))
        ))
        {
            header('Location:/?p=ruche&f=modify&error=1');
            exit;
        }
        /****Verification de la latitude, si elle est saisi et si elle correspond au format*/
        if (!((isset($_POST['latitude'])) 
        && 
        preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/', $_POST['latitude'])
        ))
        {
            header('Location:/?p=ruche&f=modify&error=2');
            exit;
        }
        /****Verification du nom, s'il est saisi*/
        if (!(isset($_POST['nom'])) || $_POST['nom'] == "") 
        {
            header('Location:/?p=ruche&f=modify&error=3');
            exit;
        }

        $stmt = $dbh->prepare("UPDATE `ruche` SET `longitude` = :longitude, `latitude` = :latitude, `nom` = :nom WHERE `id` = :id");
        $stmt->bindValue(':id',$_POST['id']);
        $stmt->bindValue(':nom',$_POST['nom']);
        $stmt->bindValue(':latitude',$_POST['latitude']);
        $stmt->bindValue(':longitude',$_POST['longitude']);

        try {
            $stmt->execute();
            header('Location:/?p=ruche&success=2');
            exit;
        } catch (Exception $e) {
            header('Location:/?p=ruche');
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
            exit;
        }
    }

    if (isset($_GET['id']))
    {
        $stmt = $dbh->prepare("SELECT * FROM `ruche` WHERE `id` = :id");
        $stmt->bindValue(':id',$_GET['id']);

        try {
            $stmt->execute();
            $value = $stmt->fetch(PDO::FETCH_ASSOC);

            require('../template/ruche/modify_ruche.php');
        } catch (Exception $e) {
            header('Location:/?p=ruche');
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
            exit;
        }
    }
    else
    {
        header('Location:/?p=ruche');
    }
}

function suppr()
{
    require '../src/connexionbdd.php';

    if (isset($_GET['id']))
    {
        $stmt = $dbh->prepare("DELETE FROM `ruche` WHERE `ruche`.`id` = :id");
        $stmt->bindValue(':id',$_GET['id']);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            header('Location:/?p=ruche');
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
            exit;
        }

        header('Location:/?p=ruche&success=3');
    }
    else
    {
        header('Location:/?p=ruche');
    }
}

function nbLines()
{

    if(isset($_POST['nbLines']))
    {
        setcookie( "limitRuchePagination", $_POST['nbLines'], strtotime( '+30 days' ));
    }
    header('Location:/?p=ruche');
}

?>