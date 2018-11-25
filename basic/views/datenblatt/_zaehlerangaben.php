<?php 
use yii\helpers\Html;
?>

<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-zaehlerangaben" href="#collapse-zaehlerangaben" aria-expanded="true" class="">
                    Zählerangaben:
                </a>
            </h4>
        </div>
        <div id="collapse-zaehlerangaben" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">
                
                <!--<h3>Zählerangaben</h3>-->

                <table class="table">
                    <tr>
                        <th>Medium-Name</th>
                        <th>Medium-Nr.</th>
                        <th>Zählerstand</th>
                        <th>Datum</th>
                        <th>Abgemeldet</th>
                        <th></th>
                    </tr>
                    <?php 
                    /* @var $zaehlerstand app\models\Zaehlerstand */
                    if ($modelDatenblatt->haus):
                    foreach ($modelDatenblatt->haus->zaehlerstands as $zaehlerstand): ?>
                        <tr>
                            <td><?= $zaehlerstand->name ?></td>
                            <td><?= $zaehlerstand->nummer ?></td>
                            <td><?= $zaehlerstand->stand ?></td>
                            <td><?= Yii::$app->formatter->asDate($zaehlerstand->datum) ?></td>
                            <td><?= $zaehlerstand->zaehler_abgemeldet ? 'ja' : 'nein' ?></td>
                            <td>
                                <?= Html::a('<span class="glyphicon glyphicon-pencil"> Bearbeiten</span>',
                                    Yii::$app->urlManager->createUrl(["teileigentumseinheit/update", 'id' => $zaehlerstand->teileigentumseinheit_id]),
                                    ['class' => 'btn btn-primary btn-xl']) ?>
                            </td>
                        </tr>
                    <?php 
                    endforeach; 
                    endif;
                    ?>
                </table>
                
            </div>
        </div>
    </div>
</div>