<?php

namespace app\searchs;

use app\models\User;
use yii\data\ActiveDataProvider;
use app\models\WorkingHour as WorkingHourModel;
use Yii;

/**
 * WorkingHour represents the model behind the search form of `app\models\WorkingHour`.
 */
class WorkingHourSearch extends WorkingHourModel
{
    public $userFilter;

    public function rules()
    {
        return [
            [['id', 'user_id', 'worked_time'], 'integer'],
            [['work_date', 'time_one', 'time_two', 'time_three', 'time_four', 'userFilter', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function search($params, $admin = false)
    {
        if ($admin) {
            $query = WorkingHourModel::find()->joinWith('user');
        } else {
            $query = WorkingHourModel::find()->where(['user_id' => Yii::$app->user->identity->id])->joinWith('user');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'worked_time' => $this->worked_time,
            'time_one' => $this->time_one,
            'time_two' => $this->time_two,
            'time_three' => $this->time_three,
            'time_four' => $this->time_four,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        if (isset($params['WorkingHourSearch']['userFilter'])) {
            $query->andFilterWhere(['like', 'users.name', $params['WorkingHourSearch']['userFilter']]);
        }

        if (isset($params['WorkingHourSearch']['work_date'])) {
            $workDate = $params['WorkingHourSearch']['work_date'];
            $startOfMonth = date('Y-m-01', strtotime($workDate));
            $endOfMonth = date('Y-m-t', strtotime($workDate));

            $query->andWhere(['between', 'work_date', $startOfMonth, $endOfMonth]);
        }

        $query->orderBy(['work_date' => SORT_ASC]);

        return $dataProvider;
    }

}
