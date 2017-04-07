<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Firma;
//use modernkernel\tinymce\TinyMce;

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\rbacDB\Role;

/* @var $this yii\web\View */
/* @var $model app\models\Projekt */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs('
    $(function(){
        new ProjektForm();
    });
    
    tinymce.init({ 
    	selector:".tinymce",
		menubar:false,
		statusbar: false,
        plugins: "table",
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect"
	});
');
?>

<div class="projekt-form">


    <?php $form = ActiveForm::begin(); ?>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-sm-6">
			<?= $form->field($model, 'firma_id')->dropDownList(ArrayHelper::map(Firma::find()->all(), 'id', 'name'))->label('Firma') ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<?= $form->field($model, 'strasse')->textInput(['tabindex' => 10]) ?>
			<?= $form->field($model, 'plz')->textInput(['tabindex' => 12]) ?>
		</div>
		<div class="col-sm-3">
			<?= $form->field($model, 'hausnr')->textInput(['tabindex' => 11]) ?>
			<?= $form->field($model, 'ort')->textInput(['tabindex' => 13]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<?= $form->field($model, 'mail_header')
				->textarea(['tabindex' => 14, 'class' => 'tinymce', 'rows' => 6])
			?>
			<?= $form->field($model, 'mail_footer')
				->textarea(['tabindex' => 15, 'class' => 'tinymce', 'rows' => 6]) ?>
		</div>
	</div>

	
	<?php 
	/*
		$roles = Role::getAvailableRoles(Yii::$app->user->isSuperAdmin, true);
		if (Yii::$app->user->isSuperadmin) {
			echo $form->field($model, 'role')->dropDownList($roles, []);
		} else {
			if (!$model->role) {
				$model->role = reset($roles);
			}
            echo $form->field($model, 'role')->hiddenInput()->label(false);
		}
	*/
	?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <?php if($model->id): ?>
	<!-- row -->
	<div class="row">

		<div class="col-md-6">
			<div class="box-group" id="accordion">
			    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
			    <div class="panel box box-primary">
			        <div class="box-header with-border">
			            <h4 class="box-title">
			                <a data-toggle="collapse" data-parent="#collapse-nachlass" href="#collapse-nachlass" aria-expanded="true" class="">
			                    Zugewiesene Benutzer:
			                </a>
			            </h4>
			        </div>

			        <div id="collapse-nachlass" class="panel-collapse collapse in" aria-expanded="false">
			            <div class="box-body">

			            	<label for="projekt-users">Suche: </label>
	  						<input id="projekt-users"
	  							data-search-url="<?= \yii\helpers\Url::to(['projekt/searchusers', ]);?>"
	  							data-add-user-assignment="<?= \yii\helpers\Url::to(['projekt/adduserassignment', 'id' => $model->id]);?>"
	  							>

			                <table class="assigned-users">
			                <?php foreach($model->users as $key => $user): ?>
			                	<tr>
			                		<td>
				                		<?php
				                			$url = \yii\helpers\Url::to(['projekt/removeuserassignment',
				                				'projektId' => $model->id,
				                				'userId' => $user->id,
			                				]);
				                			echo '<span class="glyphicon glyphicon-trash" data-url="' . $url . '"></span>';
				                		?>
			                		</td>
			                		<td><?= $user->username ?></td>
			                	</tr>
			                <?php endforeach;  ?>
			                </table>

			            </div>
			        </div>
			    </div>
			</div>
		</div>

	</div>
	<!-- /row -->
	<?php endif; ?>

</div>
