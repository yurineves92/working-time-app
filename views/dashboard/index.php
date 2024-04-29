<?php

/** @var yii\web\View $this */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .card {
        text-align: center;
    }

    .ticket-value {
        font-family: 'Arial', sans-serif;
        font-size: 24px;
    }
</style>

<div class="dashboard-index">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Tickets totais</h5>
                    <p class="card-text ticket-value"><i class="fa-regular fa-paste"></i> 3</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Tickets abertos</h5>
                    <p class="card-text ticket-value"><i class="fa-regular fa-eye"></i> 1</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Em atendimento</h5>
                    <p class="card-text ticket-value"><i class="fa fa-phone"></i> 1</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Tickets fechados</h5>
                    <p class="card-text ticket-value"><i class="fa fa-check"></i> 1</p>
                </div>
            </div>
        </div>
    </div>
</div>