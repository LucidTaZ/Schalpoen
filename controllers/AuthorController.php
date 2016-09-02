<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AuthorController extends Controller
{
    // TODO: Access control

    /**
     * Create or edit a post
     * @param int $id Post ID in case of editing
     * @return string
     */
    public function actionWrite($id = null)
    {
        return 'TODO';
    }

    public function actionDrafts()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;

        $finalized = new ActiveDataProvider(['query' => $user->getFinalizedPosts()]);
        $editables = new ActiveDataProvider(['query' => $user->getEditablePosts()]);

        return $this->render('drafts', [
            'finalized' => $finalized,
            'editables' => $editables,
        ]);
    }

    public function actionDelete($id)
    {
        return 'TODO';
    }

    public function actionFinalize($id)
    {
        return 'TODO';
    }

    public function actionUnfinalize($id)
    {
        return 'TODO';
    }
}
