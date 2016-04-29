<?php

namespace app\controllers;

use app\models\User;
use Yii;

class UserController extends \yii\web\Controller
{
    /**
     * Performs the registration of new user
     * @return string|\yii\web\Response
     */
    public function actionRegister()
    {
        $user = new User();

        if ($user->load(Yii::$app->request->post())) {
            if ($user->validate()) {
                
                // form inputs are valid, do something here
                $user->save();

                //Sends message
                Yii::$app->getSession()->setFlash('success', 'You are registered');

                return $this->redirect('/index.php');
            }
        }
        
        return $this->render('register', [
            'user' => $user,
        ]);
    }

}
