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
        $today = date('Y-m-d');
        $userId = Yii::$app->user->identity->id;
        $existingRecord = WorkingHour::findOne(['work_date' => $today, 'user_id' => $userId]);
    
        if (!$existingRecord) {
            $model = new WorkingHour();
            $model->work_date = $today;
            $model->user_id = $userId;
            $model->save();
        } else {
            $model = $existingRecord;
        }
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->time_one === null) {
                $model->time_one = date('H:i:s');
            } elseif ($model->time_two === null) {
                $model->time_two = date('H:i:s');
            } elseif ($model->time_three === null) {
                $model->time_three = date('H:i:s');
            } elseif ($model->time_four === null) {
                $model->time_four = date('H:i:s');
            }
        
            $isTimeFourUpdated = $model->isAttributeChanged('time_four');
        
            $model->save();
    
            if ($isTimeFourUpdated) {
                $model->worked_time = $this->calculateWorkedTime($model);
                $model->save(false);
            }
            
            Yii::$app->session->setFlash('success', 'Ponto adicionado com sucesso.');
            return $this->redirect(['register-point']);
        }
    
        return $this->render('register-point', [
            'model' => $model,
        ]);
    }
    
    private function calculateWorkedTime($model)
    {
        $time_one = strtotime($model->time_one);
        $time_two = strtotime($model->time_two);
        $time_three = strtotime($model->time_three);
        $time_four = strtotime($model->time_four);

        $total_seconds = ($time_two - $time_one) + ($time_four - $time_three);

        $total_hours = round($total_seconds / 3600, 2);

        return $total_hours;
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
