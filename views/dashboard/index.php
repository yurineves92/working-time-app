<?php

/** @var yii\web\View $this */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .card {
        text-align: center;
    }

    .item-value {
        font-family: 'Arial', sans-serif;
        font-size: 24px;
    }
</style>

<div class="dashboard-index">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">T. de Pontos Hoje</h5>
                    <p class="card-text item-value"><i class="bi bi-clipboard-data"></i> <?= $totalPontosHoje ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">T. de Pontos Faltantes</h5>
                    <p class="card-text item-value"><i class="bi bi-eye"></i> <?= $totalPontosFaltantes ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">T. em Horas Trabalhadas</h5>
                    <p class="card-text item-value"><i class="bi bi-clock"></i> <?= $totalHorasTrabalhadas ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">T. de Usuários</h5>
                    <p class="card-text item-value"><i class="bi bi-people"></i> <?= $totalUsuarios ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
