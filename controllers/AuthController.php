<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class AuthController extends \yii\web\Controller
{
    public $layout = "auth";
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Seja bem-vindo(a) de volta, ' . Yii::$app->user->identity->name);
            return $this->redirect(['/dashboard/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Usuário criado com sucesso.');
            return $this->redirect(['login']);
        }

        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->session->setFlash('success', 'Deslogado com sucesso.');
        return $this->redirect(['/auth/login']);
    }

    public function actionError()
    {
        return $this->render('error');
    }
}