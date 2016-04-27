<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<h1 class="page-header">
    Categories
    <a href="index.php?r=category/create" class="btn btn-primary pull-right">Create</a>
</h1>

<?php if(null !== Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success"><?=Yii::$app->session->getFlash('success')?></div>
<?php endif;?>

<ul class="list-group">
    <?php foreach ($categories as $category):?>
        <li class="list-group-item">
            <a href="/index.php?r=job&category=<?= $category->id?>"><?= $category->name?></a>
        </li>
    <?php endforeach;?>
</ul>


<?= LinkPager::widget(['pagination' => $pagination])?>
