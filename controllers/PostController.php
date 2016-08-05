<?php

namespace app\controllers;

use app\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{
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
