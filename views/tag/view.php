<?php

use app\models\Tag;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Tag */
/* @var $postsProvider ActiveDataProvider */

?>

<h2><?= Html::encode($model->title) ?></h2>

<?php foreach ($postsProvider->models as $model): ?>
    <?= $this->render('@app/views/post/_short-post', [
        'model' => $model,
    ]) ?>
<?php endforeach; ?>
