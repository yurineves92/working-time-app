<?php

/** @var yii\web\View $this */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Registro de Ponto';
$this->params['breadcrumbs'][] = $this->title;

// Array associativo com os nomes dos meses em português
$meses = [
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];

// Obter a data atual
$dataAtual = getdate();
$dia = $dataAtual['mday']; // dia do mês
$mes = $meses[$dataAtual['mon']]; // nome do mês
$ano = $dataAtual['year']; // ano

// Construir a string da data
$dataFormatada = "$dia de $mes de $ano";
?>

<div class="register-point-form">
    <div class="card">
        <div class="card-header">
            <h4><?= $dataFormatada ?></h4>
        </div>
        <div class="card-body text-center mb-4">
            <div>
                <div class="row mb-2">
                    <div class="col">
                        <h3 class="font-weight-bold">Entrada 1: <?= $model->time_one; ?></h3>
                    </div>
                    <div class="col">
                        <h3 class="font-weight-bold">Saída 1: <?= $model->time_two; ?></h3>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <h3 class="font-weight-bold">Entrada 2: <?= $model->time_three; ?></h3>
                    </div>
                    <div class="col">
                        <h3 class="font-weight-bold">Saída 2:  <?= $model->time_four; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <?php $form = ActiveForm::begin(); ?>
            <?= Html::activeHiddenInput($model, 'user_id', ['value' => Yii::$app->user->identity->id]) ?>
            <div class="card-footer text-center">
                <?php if ($model->worked_time > 0): ?>
                    <div class="alert alert-success" style="display: inline-block;">
                        <strong>Você já bateu os pontos diários hoje.</strong>
                    </div>
                <?php else: ?>
                    <?= Html::submitButton('<i class="bi bi-check-circle"></i> Bater o Ponto', ['class' => 'btn btn-success']) ?>
                <?php endif; ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
