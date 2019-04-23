<?php
namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;

class BookController extends ActiveController
{
    public $modelClass = 'app\models\Book';// Взяли пока основную модель
}