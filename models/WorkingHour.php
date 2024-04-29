<?php

namespace app\models;

use Yii;

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
            [['work_date', 'worked_time', 'created_at'], 'required'],
            [['work_date', 'time_one', 'time_two', 'time_three', 'time_four', 'created_at', 'updated_at'], 'safe'],
            [['worked_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_date' => 'Work Date',
            'time_one' => 'Time One',
            'time_two' => 'Time Two',
            'time_three' => 'Time Three',
            'time_four' => 'Time Four',
            'worked_time' => 'Worked Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
