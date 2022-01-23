<?php use App\Registry;

if (!$isPost || !empty($errors)) :?>
    <form action="" method="post"  enctype="multipart/form-data" >
        <pre>
        <?php
        if (!empty($errors))
            print_r($errors)
        ?>
        </pre>
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="<?= $title ?>">
        </div>
        <div>
            <label for="release-date">Release date (YYYY-mm-dd)</label>
            <input type="text" name="release-date" value="<?= $releaseDate ?>">
        </div>
        <div>
            <p>Rating</p>
            <?php foreach ([1, 2, 3, 4, 5] as $ratingValue) : ?>
                <label for="rating<?= $ratingValue ?>">
                    <input id="rating<?= $ratingValue ?>" type="radio" name="rating"
                           value="<?= $ratingValue ?>" <?= ($rating === $ratingValue) ? "checked":"" ?> >
                    <?= $ratingValue ?>
                </label>
            <?php endforeach ?>
        </div>
        <div>
            <label for="overview">Overview</label>
            <textarea id="overview" name="overview"><?= $overview ?></textarea>
        </div>
        <div>
            <label>Subir un POSTER: </label><input name="fileUpload" type="file" />
        </div>

        <div>
            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="submit" value="Enviar">
        </div>
    </form>
    <button><a href="<?= Registry::get(Registry::ROUTER)->generate("movie_list")?>">Volver al menú</a></button>

<?php endif; ?>
<?php if (empty($errors) && $isPost) : ?>
    <table>
        <tr>
            <th>Title</th>
            <td><?= $title ?></td>
        </tr>
        <tr>
            <th>Overview</th>
            <td><?= $overview ?></td>
        </tr>
        <tr>
            <th>Release date</th>
            <td><?= date("d/m/Y", strToTime($releaseDate)) ?></td>
        </tr>
        <tr>
            <th>Rating</th>
            <td><?= $rating ?></td>
        </tr>
        <tr>
            <th>Poster</th>
            <td><img src="<?php echo $poster["name"]; ?>" /></td>
        </tr>
    </table>
    <button><a href="<?= Registry::get(Registry::ROUTER)->generate("movie_list")?>">Volver al menú</a></button>

<?php endif; ?>