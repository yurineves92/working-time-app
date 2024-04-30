<?php

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .header-blue {
            background-color: #1976d2;
            color: #ffffff;
            padding: 10px;
        }
        .header-blue .dropdown-menu {
            background-color: #007bff;
        }
        .header-blue .dropdown-menu .dropdown-item {
            color: #ffffff; /* Cor do texto do dropdown */
        }
        .sidebar {
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding-top: 20px;
            height: 100vh; /* Definindo altura máxima como 100% da janela */
        }
        .sidebar .nav-link {
            padding: 10px 10px;
            color: #333333;
            text-decoration: none;
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
        }
        .sidebar.d-none {
            display: none;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".btn-sidebar-toggle").click(function() {
                $("#sidebarMenu").toggleClass("d-none");
                $("#sidebarColumn").toggleClass("col-md-3 col-lg-2");
                $("#contentColumn").toggleClass("col-md-9 col-lg-10");
            });
        });
    </script>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="header-blue">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h3 style="color: white; margin-right: 8rem;"><?= Yii::$app->name; ?></h3>
                <button class="btn btn-primary btn-sidebar-toggle me-2"><i class="bi bi-list" style="color: white;"></i></button>
            </div>
            <div class="dropdown">
                <span><strong>Bem vindo, </strong><?= Yii::$app->user->identity->name; ?></span>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <div id="sidebarColumn" class="col-md-3 col-lg-2 d-md-block bg-white">
            <nav id="sidebarMenu" class="sidebar">
                <div class="position-sticky">
                    <div class="nav flex-column">
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->level == 1): ?>
                            <a class="nav-link" href="/dashboard/index"><i class="bi bi-house-door"></i> Dashboard</a>
                            <a class="nav-link" href="/working-hour/register-point"><i class="bi bi-clock-history"></i> Registrar Ponto</a>
                            <a class="nav-link" href="/working-hour/report-month"><i class="bi bi-calendar"></i> Relatório Mensal</a>
                            <a class="nav-link" href="/working-hour/report-administrator"><i class="bi bi-graph-up"></i> Relatório Gerencial</a>
                        <?php else: ?>
                            <a class="nav-link" href="/working-hour/register-point"><i class="bi bi-clock-history"></i> Registrar Ponto</a>
                            <a class="nav-link" href="/working-hour/report-month"><i class="bi bi-calendar"></i> Relatório Mensal</a>
                        <?php endif; ?>
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->level == 1): ?>
                            <hr style="width: 95%;"/>
                            <a class="nav-link" href="/user/index"><i class="bi bi-people"></i> Usuários</a>
                        <?php endif; ?>
                        <hr style="width: 95%;"/>
                        <a class="nav-link" href="/user/profile"><i class="bi bi-person-fill"></i> Perfil</a>
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <?= Html::beginForm(['/auth/logout'], 'post'); ?>
                            <?= Html::submitButton('<i class="bi bi-box-arrow-in-left"></i> Sair', ['class' => 'btn btn-link nav-link','style' => 'width:95%']); ?>
                            <?= Html::endForm(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>

        <main id="contentColumn" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <section class="py-4">
                <div class="container-fluid">
                    <?php if (!empty($this->params['breadcrumbs'])): ?>
                        <?= Breadcrumbs::widget(['homeLink'=> ['label' => 'Página Inicial', 'url' => '/dashboard/index'],'links' => $this->params['breadcrumbs']]) ?>
                    <?php endif ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </section>
        </main>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
