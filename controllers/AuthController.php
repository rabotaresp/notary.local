<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin()
    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
        $model = new Users();
        if(Yii::$app->request->post('Users')){
            $req = Yii::$app->request->post('Users');
            $login = $req['login'];
            $pass = $req['pass'];
            $user = Users::find()->andWhere(['login'=>$login])->one();
            if ($user){
                if(\Yii::$app->security->validatePassword($pass, $user->pass)){
                    \Yii::$app->user->login($user);
                    return (Yii::$app->user->identity->role == 2)?$this->redirect(['notary/notary']):$this->redirect(['client/client']);
//                    if(Yii::$app->user->identity->role == 2){
//                        return $this->redirect('/notarius/notarius');
//                    }
//                    return $this->redirect('/client/client');
                }
            }
            else{
                $err = "Логин не зарегистрирован, пройдите регистрацию";
            }
        }
        return $this->render('login',['model'=>$model,'err' => $err]);
    }
    public function actionReg()
    {
        $newUser = new Users();
        if(Yii::$app->request->post('Users')) {
            $req = Yii::$app->request->post('Users');
            $name = $req['name'];
            $login = $req['login'];
            $pass = $req['pass'];
            $role = $req['role'];
            $user = Users::find()->andWhere(['login' => $login])->one();
            if (!$user) {
                $newUser->name = $name;
                $newUser->login = $login;
                $newUser->pass = Yii::$app->security->generatePasswordHash($pass);
                $newUser->role = $role;
                $newUser->save();
                if (!$newUser->save()) {
                    echo'<pre>';
                    print_r($newUser->errors);
                    exit();
                }
                \Yii::$app->user->login($newUser);
                return ($role == 2)?$this->redirect(['/notariy/notary']):$this->redirect(['client/client']);
//                if($role==2)
//                {
//                    \Yii::$app->user->login($newUser);
//                    return $this->redirect('/notarius/notarius');
//                }
//                \Yii::$app->user->login($newUser);
//                return $this->redirect(['client/client']);
            }
            else {
                $err = "Логин занят, выберите другой";
            }
        }
        $newUser->name = '';
        $newUser->login = '';
        $newUser->pass = '';
        return $this->render('reg', ['model' => $newUser, 'err' => $err]);
    }
}
