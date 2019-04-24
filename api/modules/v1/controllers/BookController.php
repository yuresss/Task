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
    // Не насторил, использовать нативный update от yii\rest\ActiveController
/*    public function actionUpdate($id) {

        $claim = $this->findModel($id);
        $claim->scenario = 'update';

        if ( $claim->status_id == 1 ) {

            $request = Yii::$app->request;

            if (isset($request)) {

                $name = $request->getBodyParam('name');
                $edition = $request->getBodyParam('edition');
                $description = $request->getBodyParam('description');
                $autor_id = $request->getBodyParam('autor_id');

                if ($claim->validate() ) {
                    $claim->save();

                    return array('id'=>$claim->id,'msg'=>'Successfully update claim');

                } else {
                    return (ActiveForm::validate($claim));
                }
            }
        } else {
            throw new \yii\web\MethodNotAllowedHttpException('You are not allowed to update data');
        }
    }*/

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