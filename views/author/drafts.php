<?php

use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $finalized DataProviderInterface */
/* @var $editables DataProviderInterface */

$this->title = 'Concepten';

?>
<h2><?= Html::encode($this->title) ?></h2>

<?php if ($finalized->getCount() == 0 && $editables->getCount() == 0): ?>
    <div class="mededeling">
        Al je artikelen zijn gepubliceerd of afgerond en kunnen daarom niet gewijzigd worden.
    </div>
<?php endif; ?>

<?php if ($finalized->getCount() > 0): ?>
    <h3>Afgerond</h3>
    (Todo)<br />
<?php endif; ?>

<?php if ($editables->getCount() > 0): ?>
    <h3>In progress</h3>
    (Todo)<br />
<?php endif; ?>
