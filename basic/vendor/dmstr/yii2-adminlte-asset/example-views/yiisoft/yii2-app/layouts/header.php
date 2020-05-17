<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ABG</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                
                
                <!-- Tasks: style can be found in dropdown.less -->
                
                <!-- User Account: style can be found in dropdown.less -->

               

                <!-- User Account: style can be found in dropdown.less -->
               <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->

                <?php if (getenv('APPLICATION_ENV') != 'live'): ?>
                    <li>
                        <a style="color: black; font-weight: bold; font-size:17px;">ENV: <?= getenv('APPLICATION_ENV') ?></a>
                    </li>
                <?php endif; ?>

                <li>
                    <?= Html::a('<i class="fa fa-fw fa-sign-out"></i>Logout', ['/user-management/auth/logout'], ['class' => 'btn btn-default btn-primary']) ?>
                </li>

            </ul>
        </div>
    </nav>
</header>
