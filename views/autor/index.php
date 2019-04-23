<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AutorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Autors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Autor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            ['attribute' => 'birth', 'format' => ['date', 'php:d.m.Y']],
            'biography:ntext',
            [
                'attribute'=>'books',
                'label'=>'Books',
                'value'=>function($model){
                    return $model->getBooks()->count();
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
