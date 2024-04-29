<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Cadastre-se';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1 class="h3 mb-3 fw-normal text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Já tem uma conta? <a href="/auth/login">Fazer login!</a></p>

    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-floating'],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->label('Nome:')->textInput(['placeholder' => 'Informe o seu nome', 'autofocus' => true]) ?>
    
    <?= $form->field($model, 'username')->label('Nome do Usuário:')->textInput(['placeholder' => 'Informe o seu usuário', 'autofocus' => true]) ?>

    <?= $form->field($model, 'email')->label('Email:')->textInput(['placeholder' => 'Informe o seu e-mail', 'autofocus' => true]) ?>

    <?= $form->field($model, 'password')->label('Senha:')->passwordInput(['placeholder' => 'Informe a sua senha']) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Criar conta', ['class' => 'w-100 btn btn-lg btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <p class="mt-5 mb-3 text-muted text-center">© Copyright 2024</p>
    <?php ActiveForm::end(); ?>
</div>