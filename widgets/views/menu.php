<?php

use app\models\Post;
use app\models\Tag;
use yii\web\View;

/* @var $this View */
/* @var $recentPosts Post[] */
/* @var $popularTags Tag[] */

?>
<p>
    <a href="#">Home</a><br />
    <a href="#">Archief</a><br />
    <a href="#">RSS</a><br />
</p>

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

<p>
    Auteur:<br />
    <a href="#">Artikel schrijven</a><br />
    <a href="#">Concepten (x)</a><br />
</p>

<p>
    Redacteur:<br />
    <a href="#">Publiceren (x)</a><br />
</p>

<p>
    Recente artikelen:<br />
    ...<br />
</p>

<p>
    Populaire tags:<br />
    ...<br />
</p>
