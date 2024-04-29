<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "working_hours".
 *
 * @property int $id
 * @property string $work_date
 * @property string|null $time_one
 * @property string|null $time_two
 * @property string|null $time_three
 * @property string|null $time_four
 * @property int $worked_time
 * @property string $created_at
 * @property string|null $updated_at
 */
class WorkingHour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'working_hours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_date', 'time_one', 'time_two', 'time_three', 'time_four', 'created_at', 'updated_at'], 'safe'],
            [['worked_time'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Cod.',
            'work_date' => 'Data de Trabalho',
            'time_one' => 'Entrada 1',
            'time_two' => 'Saída 1',
            'time_three' => 'Entrada 2',
            'time_four' => 'Saída 2',
            'worked_time' => 'Tempo Trabalhado',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()')
            ]
        ];
    }

    public function updateTimes()
    {
        if ($this->time_one === null) {
            $this->time_one = date('H:i:s');
        } elseif ($this->time_two === null) {
            $this->time_two = date('H:i:s');
        } elseif ($this->time_three === null) {
            $this->time_three = date('H:i:s');
        } elseif ($this->time_four === null) {
            $this->time_four = date('H:i:s');
        }
    }
}
