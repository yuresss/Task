<?php
namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
//use api\modules\v1\models\Book;
use app\models\Book;
use yii\web\Response;
use yii\helpers\ArrayHelper;

class BookController extends ActiveController
{
    public $modelClass = 'app\models\Book';// Взяли пока основную модель

    //Устанавливаем принудительный ответ в json
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ]);
    }
    public function actionList()
    {
        return Book::find()->all();
    }
    public function actionById($id)
    {
        if (($book = Book::findOne($id)) !== null) {
            return $book;
        }
        return 'not find';
    }
}