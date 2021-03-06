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
    /**
     * Creates a new job
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $job = new Job();

        if ($job->load(Yii::$app->request->post())) {
            if ($job->validate()) {
                // form inputs are valid, do something here
                $job->save();

                //Sends message
                Yii::$app->getSession()->setFlash('success', 'Job Added');

                return $this->redirect('/index.php?r=job');
            }
        }

        return $this->render('create', [
            'job' => $job,
        ]);
    }

    /**
     * Deletes an existing job
     * @param $id
     * @return \yii\web\Response
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $job = Job::findOne($id);

        if($job->user_id !== Yii::$app->user->identity->id)
            return $this->redirect('/index.php?r=job');
        
        $job->delete();

        Yii::$app->getSession()->setFlash('success', 'Job Deleted');

        return $this->redirect('/index.php?r=job');
    }

    /**
     * Updates an existing job
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $job = Job::findOne($id);

        if($job->user_id !== Yii::$app->user->identity->id)
            return $this->redirect('/index.php?r=job');

        if ($job->load(Yii::$app->request->post())) {
            if ($job->validate()) {
                // form inputs are valid, do something here
                $job->save();

                //Sends message
                Yii::$app->getSession()->setFlash('success', 'Job Updated');

                return $this->redirect('/index.php?r=job');
            }
        }

        return $this->render('edit', [
            'job' => $job,
        ]);
    }

    /**
     * Determines the availability of main class methods
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit', 'delete'],
                'rules' => [
                        [
                        'actions' => ['create', 'edit', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
                        ],
                    ],
            ]
        ];
    }

    /**
     * Displays the job details
     * @param $id
     * @return string
     */
    public function actionDetails($id)
    {
        //Finds job by id
        $job = Job::find()->where(['id' => $id])->one();

        return $this->render('details', [
            'job' => $job
        ]);
    }

    /**
     * Renders the job list
     * @return string
     */
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
