<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<h1 class="page-header">Categories</h1>

<ul class="list-group">
    <?php foreach ($categories as $category):?>
        <li class="list-group-item">
            <?= $category->name?>
        </li>
    <?php endforeach;?>
</ul>