<?php

namespace app\controllers;

use app\models\Post;
use lucidtaz\analytics\yii2\behaviors\PageviewBehavior;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'pageview' => [
                'class' => PageviewBehavior::className(),
            ],
        ];
    }

    public function actionView(int $id)
    {
        $model = Post::findOne($id);
        if ($model === null || !$model->isPublished) {
            throw new NotFoundHttpException('Post niet gevonden');
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
