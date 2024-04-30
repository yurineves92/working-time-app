<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\WorkingHour;
use app\models\User;

class SeedController extends Controller
{
    public function actionIndex()
    {
        $faker = \Faker\Factory::create();
        
        // Obtém os IDs dos usuários
        $userIds = User::find()->select('id')->column();
        
        // Data inicial e final do mês de abril
        $startDate = '2024-04-01';
        $endDate = '2024-04-28';
        
        // Loop para inserir dados para cada usuário e cada dia do mês de abril
        foreach ($userIds as $userId) {
            $currentDate = $startDate;
            while ($currentDate <= $endDate) {
                $workingHour = new WorkingHour();
                $workingHour->work_date = $currentDate;
                $workingHour->time_one = $faker->time('H:i:s');
                $workingHour->time_two = $faker->time('H:i:s');
                $workingHour->time_three = $faker->time('H:i:s');
                $workingHour->time_four = $faker->time('H:i:s');
                $workingHour->worked_time = rand(1, 8); // Horas trabalhadas aleatórias
                $workingHour->user_id = $userId;
                $workingHour->created_at = $faker->dateTimeThisMonth('now', 'UTC')->format('Y-m-d H:i:s');
                $workingHour->save();
                
                // Avança para o próximo dia
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }
        }
        
        echo "Inserção concluída.";
    }
}