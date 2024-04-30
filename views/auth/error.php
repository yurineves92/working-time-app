<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = "• 404 •";
?>
<div class="site-error">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido.
    </div>
    <p class="text-center">
        <?= Html::a('Acesso ao Sistema', ['/dashboard/index'], ['class' => 'btn btn-secondary']) ?>
    </p>
</div>