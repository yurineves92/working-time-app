<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\searchs\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Relatório Gerencial');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-administrator">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search_administrator', ['model' => $searchModel]); ?>

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
                'label' => 'Nome do Usuário',
                'value' => function ($model) {
                    return $model->user->name;
                },
            ],
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
        ]);
    ?>

    <?php Pjax::end(); ?>

</div>