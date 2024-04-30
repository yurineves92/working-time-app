<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\searchs\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Relatório Mensal');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-month">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search_month', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'options' => ['class' => 'pagination justify-content-center'],
            'prevPageLabel' => 'Anterior',
            'nextPageLabel' => 'Próximo',
            'maxButtonCount' => 5,
            'linkOptions' => ['class' => 'page-link'],
            'disabledPageCssClass' => 'disabled',
            'disabledListItemSubTagOptions' => ['tag' => 'span', 'class' => 'page-link'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'work_date',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->work_date, 'php:d/m/Y');
                },
            ],
            'time_one',
            'time_two',
            'time_three',
            'time_four',
            'worked_time',
        ],
    ]);?>

    <?php Pjax::end(); ?>

</div>