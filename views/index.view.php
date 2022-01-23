<?php

use App\FlashMessage;
use App\Registry;

if($userId != null){
?>
<h1><?= $msjBienvenida ?></h1>
    <button><a href="<?=Registry::get(Registry::ROUTER)->generate("movie_create") ?>">Crear Película</a></button>
    <button><a href="<?= Registry::get(Registry::ROUTER)->generate("movie_deleteWithoutId")?>">Eliminar Película</a></button>

    <h1>Movies:</h1>
<?php
foreach ($movies as $movieSelected){
    ?>
    <h3>Movie <?php echo array_search($movieSelected, $movies) +1;?></h3>
    <p>Id: <?php echo $movieSelected->getId(); ?></p>
    <p>Title: <a href="<?=Registry::get(Registry::ROUTER)->generate("movie_view",  ["id" => $movieSelected->getId()])?>"><?php echo $movieSelected->getTitle(); ?></a></p>
    <p>Overview: <?php echo $movieSelected->getOverview(); ?></p>
    <p>Release Date: <?php echo $movieSelected->getReleaseDate(); ?></p>
    <p>Stars Rating: <?php echo $movieSelected->getStarsRating(); ?></p>
    <p>Poster: <?php echo $movieSelected->getPoster(); ?></p>
<?php }}