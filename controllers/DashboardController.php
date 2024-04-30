<?php

namespace app\controllers;

use app\models\User;
use app\models\WorkingHour;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DashboardController extends Controller
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

    public function actionIndex()
    {
        $totalPontosHoje = WorkingHour::find()
            ->where(['DATE(work_date)' => date('Y-m-d')])
            ->count();

        $totalPontosFaltantes = WorkingHour::find()
            ->where(['DATE(work_date)' => date('Y-m-d')])
            ->andWhere(['or', ['time_one' => null], ['time_two' => null], ['time_three' => null], ['time_four' => null]])
            ->count();

        $totalHorasTrabalhadas = WorkingHour::find()
            ->where(['DATE(work_date)' => date('Y-m-d')])
            ->sum('worked_time');

        $totalUsuarios = User::find()->count();

        return $this->render('index', [
            'totalPontosHoje' => $totalPontosHoje,
            'totalPontosFaltantes' => $totalPontosFaltantes,
            'totalHorasTrabalhadas' => $totalHorasTrabalhadas,
            'totalUsuarios' => $totalUsuarios,
        ]);
    }
}