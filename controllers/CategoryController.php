<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;

class CategoryController extends Controller
{
    /**
     * Creates a new category
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $category = new Category();

        if ($category->load(Yii::$app->request->post())) {

            //Validation
            if ($category->validate()) {

                //Saves record
                $category->save();

                //Sends message
                Yii::$app->getSession()->setFlash('success', 'Category Added');

                return $this->redirect('/index.php?r=category');
            }
        }

        return $this->render('create', [
            'category' => $category,
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
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ]
        ];
    }

    /**
     * Displays the categories
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        //Creates query
        $query = Category::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count()
        ]);

        $categories = $query->orderBy('name')
                            ->offset($pagination->offset)
                            ->limit($pagination->limit)
                            ->all();

        return $this->render('index', [
            'pagination' => $pagination,
            'categories' => $categories
        ]);
    }

}
