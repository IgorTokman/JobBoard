<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;
use app\models\Job;

class JobController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $foo = 'Bar';
        return $this->render('create', ['foo' => $foo]);
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionDetails()
    {
        return $this->render('details');
    }

    public function actionIndex()
    {
        //Creates query
        $query = Job::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count()
        ]);

        $jobs = $query->orderBy('create_date')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'pagination' => $pagination,
            'jobs' => $jobs
        ]);
    }

}
