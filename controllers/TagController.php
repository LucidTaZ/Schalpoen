<?php

namespace app\controllers;

use app\models\Tag;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TagController extends Controller
{
    public function actionView(int $id)
    {
        $model = Tag::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Tag niet gevonden');
        }
        $postsQuery = $model->getPublishedPosts();
        return $this->render('view', [
            'model' => $model,
            'postsProvider' => new ActiveDataProvider(['query' => $postsQuery]),
        ]);
    }
}
