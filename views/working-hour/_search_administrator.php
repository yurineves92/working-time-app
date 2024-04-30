<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\searchs\BudgeteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-administrator-search mb-2">
    <?php $form = ActiveForm::begin([
        'action' => ['report-administrator'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'class' => 'row g-3 align-items-center', 
        ]
    ]); ?>

    <div class="col-md-2"> 
        <?= $form->field($model, 'userFilter')->label('Usuário')->textInput(['type' => 'text', 'class' => 'form-control']) ?>
    </div>

    <div class="col-md-2"> 
        <?= $form->field($model, 'work_date')->label('Mês de Trabalho')->textInput(['type' => 'month', 'class' => 'form-control']) ?>
    </div>

    <div class="col-auto"> 
        <label class="">Filtros: </label><br/>
        <?= Html::submitButton(Yii::t('app', 'Pesquisar'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Limpar'), ['working-hour/report-administrator'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>



