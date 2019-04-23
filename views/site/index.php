<?php
//var_dump($autors); return;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Авторы и их произведения</h1>
    </div>

    <table class="body-content">
        <?php
            foreach ($autors as $autor){
                //var_dump($autor->getBooks()); return;
                include "intro_autor.php";
            } ?>
    </table>
</div>
