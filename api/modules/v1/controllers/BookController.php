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
        return "{'error': 'does not exist'}";
    }
    //
    public function actionUpdate($id, $autor_id, $edition = null, $description = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    // Удаляем книку с заданным ID
    public function actionId($id)
    {
        if (($book = Book::findOne($id)) !== null) {
            $book->delete();
            return "{'status': 'success'}";
        }
        return "{'error': 'does not exist'}";
    }

}