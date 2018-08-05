<?php
/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use \yii\helpers\ArrayHelper;
?>


          <?php if(count($konfigurationen) > 0): ?>
            <?php $index = 0; ?>
				      <?php foreach ($konfigurationen as $konfiguration): ?>	
                <?php $index++; ?>
                  <?php $form = ActiveForm::begin([
                    'id'      => 'login-konfiguration'.$konfiguration->id,
                    'action' => ['auth/login-konfiguration', 'id' => $konfiguration->id, 'zustimmung' => $konfiguration->zustimmung],
                    'enableClientScript' => true,
                  ]) ?>

                      <?php Modal::begin([
                      ]);

                      Modal::end(); ?>
                        
                        <!-- Modal -->
                       <div id="myTextModal-<?= $index ?>" class="modal large fade" role="dialog">
                          <div class="modal-dialog" style="width: 600px;">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Konfiguration f&uuml;r <?= $konfiguration->name ?></h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12"><?= $konfiguration->text ?></div>
                                </div>
                               </div>
                              <div class="modal-footer">
                                <?php if($konfiguration->zustimmung == 0): ?>
                                 <?= Html::submitButton('Information gelesen', ['name' => 'submit-button', 'class' => 'btn btn-default']); ?>
                                <?php endif; ?>                                
                                <?php if($konfiguration->zustimmung == 1): ?>
                                 <?= Html::submitButton('Zustimmen', ['name' => 'submit-button', 'class' => 'btn btn-primary']); ?>
                                <?php endif; ?>
                              </div>
                            </div>
                        
                          </div>
                        </div>


                 <?php ActiveForm::end() ?>

               <?php endforeach; ?>
            <?php endif; ?>


    <?php
    $this->registerJs('

        $(function(){

            var countkonfigurationen = '.count($konfigurationen).';

            for(var k=1; k <= countkonfigurationen; k++)
            {
               $("#myTextModal-"+k).modal("show");
            }             
                       
        });
    ');
    ?>        