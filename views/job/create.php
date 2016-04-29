<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form ActiveForm */
?>
<div class="job-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($job) ?>

        <?= $form->field($job, 'category_id')
            ->dropDownList(Category::find()
                    ->select(['name', 'id'])
                    ->indexBy('id')
                    ->column(), ['prompt' => 'Select Category']) ?>
        
        <?= $form->field($job, 'title') ?>

        <?= $form->field($job, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($job, 'requirements') ?>

        <?= $form->field($job, 'type')->dropDownList([
                      'full_time' => 'Full Time',
                      'part_time' => 'Part Time',
                      'as_needed' => 'As Needed'
                    ],
                        ['prompt' => 'Select Type']) ?>

        <?= $form->field($job, 'salary_renge')->dropDownList([
                    'Under $20k' => 'Under $20k',
                    '20k - 40k' => '20k - 40k',
                    '40k - 60k' => '40k - 60k',
                    '60k - 80k' => '60k - 80k',
                    'Over 80k' => 'Over 80k'
                ],
                        ['prompt' => 'Select Salary Range']) ?>

        <?= $form->field($job, 'city') ?>

        <?= $form->field($job, 'state') ?>

        <?= $form->field($job, 'zipcode') ?>

        <?= $form->field($job, 'contact_email') ?>

        <?= $form->field($job, 'contact_phone') ?>

        <?= $form->field($job, 'is_published')->radioList([
                    '1' => 'Yes',
                    '0' => 'No'
                ]) ?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- job-create -->
