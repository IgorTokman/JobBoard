<a href="/index.php?r=job">Back to Job List</a>
<h2 class="page-header">
    <?=$job->title?>
    <small> in <?=$job->city?>, <?=$job->state?></small>

    <?php if(\Yii::$app->user->identity->id === $job->user_id):?>
        <span class="pull-right">
            <a class="btn btn-primary" href="index.php?r=job/edit&id=<?=$job->id?>">Edit</a>
            <a class="btn btn-danger" href="index.php?r=job/delete&id=<?=$job->id?>">Delete</a>
        </span>
    <?php endif;?>
</h2>

<div class="well">
    <h4>Job Description</h4>
    <?=$job->description?>
</div>

<ul class="list-group">
    <?php if(!empty($job->create_date)):?>
        <li class="list-group-item">
            <strong>Listing Date:</strong> <?=date("F j, Y, g:ia", strtotime($job->create_date))?>
        </li>
    <?php endif;?>

    <?php if(!empty($job->category)):?>
        <li class="list-group-item">
            <strong>Category:</strong> <?=$job->category->name?>
        </li>
    <?php endif;?>

    <?php if(!empty($job->contact_email)):?>
        <li class="list-group-item">
            <strong>Contact Email:</strong> <?=$job->contact_email?>
        </li>
    <?php endif;?>

    <?php if(!empty($job->contact_email)):?>
        <li class="list-group-item">
            <strong>Employment Type:</strong> <?=$job->type?>
        </li>
    <?php endif;?>

    <?php if(!empty($job->salary_renge)):?>
        <li class="list-group-item">
            <strong>Salary Range:</strong> <?=$job->salary_renge?>
        </li>
    <?php endif;?>

    <?php if(!empty($job->contact_phone)):?>
        <li class="list-group-item">
            <strong>Contact Phone:</strong> <?=$job->contact_phone?>
        </li>
    <?php endif;?>

</ul>

<a class="btn btn-primary" href="mailto:<?=$job->contact_email?>? Subject = Job%20Application">Contact Employer</a>