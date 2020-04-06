<?php 

require_once 'Datas.php';

$seeAll = Datas::getAll();

$seeGenres = Datas::getGenre();

$getGenres = Datas::getFilmsByGenres();

function debug($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
  }

  function dateFr($date){
    return strftime('%d-%m-%Y',strtotime($date));
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
    
        <?php foreach($seeAll as $seeOne) : ?>
        <div class="card col-4 m-5">
            <div class="meta">
                <h2 class="mb-5 title"><?= ucfirst($seeOne->titre)?></h2>
                <p><strong> Date de sortie :</strong> <?= dateFr($seeOne->date_sortie) ?></p>
                <p><strong> Réalisateur :</strong> <?= ucwords($seeOne->realisateur) ?></p>
                <p><strong>Acteurs :</strong> <?php foreach($seeOne->actors as $actor) :?>
                <?= ucfirst($actor['nom']).' ' .ucfirst($actor['prenom']).','?>
                <?php endforeach; ?></p>
                <p><strong>Synopsis : </strong><?= substr($seeOne->synopsis , 0 , 250)   ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach($seeGenres as $seeGenre) : ?>
        <div class="input-group-text col-6">
            <input type="checkbox"  aria-label="Checkbox for following text input">
            <?= $seeGenre['name'] ?>
        </div>
    <?php endforeach; ?>
    
   
    </div>
    </div>

<div class="ui-widget">
    <label for="tags">Recherche: </label>
    <input id="recherche">
</div>
<script src="app.js"></script>

</body>
</html>