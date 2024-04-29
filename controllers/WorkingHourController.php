<?php

namespace app\controllers;

use app\models\WorkingHour;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class WorkingHourController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->session->setFlash('success', 'Efetue o login para acessar o sistema!');
                    return Yii::$app->user->loginRequired();
                },
            ]
        ];
    }

    public function actionRegisterPoint()
    {
        $model = new WorkingHour();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        return $this->render('register-point');
    }

    public function actionReportMonth()
    {
        return $this->render('report-month');
    }

    public function actionReportAdministrator()
    {
        return $this->render('report-administrator');
    }
}
