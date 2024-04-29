<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Fazer Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1 class="h3 mb-3 fw-normal text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Ainda não tem conta? <a href="/auth/register">Cadastra-se!</a></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-floating'],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->label('Email:')->textInput(['placeholder' => 'Informe seu e-mail', 'autofocus' => true]) ?>

    <?= $form->field($model, 'password')->label('Senha:')->passwordInput(['placeholder' => 'Informe sua senha']) ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"checkbox mb-3\">{error}</div>",
    ]) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Entrar', ['class' => 'w-100 btn btn-lg btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <p class="mt-5 mb-3 text-muted text-center">© Copyright 2024</p>
    <?php ActiveForm::end(); ?>
</div>