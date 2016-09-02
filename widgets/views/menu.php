<?php

use app\models\Post;
use app\models\Tag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $draftCount int */
/* @var $recentPosts Post[] */
/* @var $popularTags Tag[] */
/* @var $isAuthor bool */
/* @var $isPublisher bool */

?>
<p>
    <a href="<?= Url::home() ?>">Home</a><br />
    <a href="#">Archief</a><br />
    <a href="#">RSS</a><br />
</p>

<?php /*
<p>
    <!-- TODO: Move into NavBar -->
    <a href="#">Inloggen</a><br />
    <a href="#">Registreren</a><br />
</p>

<p>
    <!-- TODO: Move into NavBar -->
    Ingelogd als <...><br />
    <a href="#">Profiel</a><br />
    <a href="#">Uitloggen</a><br />
</p>
*/ ?>

<?php if ($isAuthor): ?>
    <p>
        Auteur:<br />
        <a href="#">Artikel schrijven</a><br />
        <?php if ($draftCount == 0): ?>
            <a href="<?= Url::toRoute(['/author/drafts']) ?>">Concepten</a><br />
        <?php else: ?>
            <a href="<?= Url::toRoute(['/author/drafts']) ?>">Concepten (<?= Html::encode($draftCount) ?>)</a><br />
        <?php endif; ?>
    </p>
<?php endif; ?>

<?php if ($isPublisher): ?>
    <p>
        Redacteur:<br />
        <a href="#">Publiceren (x)</a><br />
    </p>
<?php endif; ?>

<p>
    Recente artikelen:<br />
    <?php foreach ($recentPosts as $recentPost): ?>
        <?= Html::a(Html::encode($recentPost->title), Url::toRoute($recentPost->route)) ?><br />
    <?php endforeach; ?>
</p>

<p>
    Populaire tags:<br />
    <?= implode(', ', array_map(
        function (Tag $tag) {
            return Html::a(Html::encode($tag->title), Url::toRoute($tag->route));
        },
        $popularTags
    )) ?><br />
</p>
