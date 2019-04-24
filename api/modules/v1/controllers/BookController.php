<?php
namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
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
    // Возвращаем список книг
    public function actionList()
    {
        return Book::find()->all();
    }
    // Возвращаем список книгу по ID
    public function actionById($id)
    {
        if (($book = Book::findOne($id)) !== null) {
            return $book;
        }
        throw new \yii\web\MethodNotAllowedHttpException('Element does not exist');
    }

    // Test update
    public function actionUpdate($id)
    {
        if (! Yii::$app->request->isPut) {
            throw new \yii\web\MethodNotAllowedHttpException('Please use PUT');
        }
        /** @var User $user */
        if (($book = Book::findOne($id)) !== null) {
            $model = new Book();

            // populate model attributes with user inputs
            $model->load(\Yii::$app->request->post());
            // which is equivalent to the following:
            // $model->attributes = \Yii::$app->request->post('name');

            if ($model->validate()) {
                return $book->save();
            } else {
                // validation failed: $errors is an array containing error messages
                return $model->errors;
            }
        }
        else throw new \yii\web\MethodNotAllowedHttpException('Element does not exist');
    }

    // Удаляем книку с заданным ID
    public function actionId($id)
    {
        if (($book = Book::findOne($id)) !== null) {
            return $book->delete();
        }
        else throw new \yii\web\MethodNotAllowedHttpException('Element does not exist');
    }

}