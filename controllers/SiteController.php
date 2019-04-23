<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\AutorSearch;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModelAutors = new AutorSearch();

        return $this->render('index', [
            'autors' => $searchModelAutors->getAll(),
        ]);
    }
}
