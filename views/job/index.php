<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<h1 class="page-header">
    Jobs
    <a href="index.php?r=job/create" class="btn btn-primary pull-right">Create</a>
</h1>

<?php if(null !== Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success"><?=Yii::$app->session->getFlash('success')?></div>
<?php endif;?>

<?php if(!empty($jobs)) : ?>
    <ul class="list-group">
        <?php foreach ($jobs as $job):?>
            <li class="list-group-item">
                <a href="/index.php?r=job/details&id=<?= $job->id?>">
                    <?= $job->title?> - <strong><?= $job->city?>  <?=$job->state?></strong> -
                    Listed on <?=date("F j, Y, g:ia", strtotime($job->create_date))?>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <p>No jobs to list</p>
<?php endif; ?>

<?= LinkPager::widget(['pagination' => $pagination])?>
