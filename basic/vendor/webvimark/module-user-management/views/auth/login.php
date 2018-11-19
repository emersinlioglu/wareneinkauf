<?php
/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use \yii\helpers\ArrayHelper;
use \app\models\Projekt;
?>

<div class="container" id="login-wrapper">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= UserManagementModule::t('front', 'Authorization') ?></h3>
				</div>
				<div class="panel-body">

					<?php $form = ActiveForm::begin([
						'id'      => 'login-form',
						'action' => ['/user-management/auth/login'],
						'options'=>['autocomplete'=>'off'],
						'validateOnBlur'=>false,
						'fieldConfig' => [
							'template'=>"{input}\n{error}",
						],
					]) ?>

                    <div class="form-group field-datenblatt-firma_id has-success">
                        <?= Html::dropDownList('projekt_id', null,
                            ArrayHelper::map(Projekt::find()->all(), 'id', 'name'),
                            array('label' => 'Dimension type', 'class' => 'form-control',
                                'prompt'=>'Projekt auswählen', 'required' => 'required')) ?>
                    </div>

					<?= $form->field($model, 'username')
						->textInput(['placeholder'=>$model->getAttributeLabel('username'), 'autocomplete'=>'off']) ?>

					<?= $form->field($model, 'password')
						->passwordInput(['placeholder'=>$model->getAttributeLabel('password'), 'autocomplete'=>'off']) ?>

					<?= $form->field($model, 'rememberMe')->checkbox(['value'=>true]) ?>

					<?= Html::submitButton(
						UserManagementModule::t('front', 'Login'),
						['class' => 'btn btn-lg btn-primary btn-block']
					) ?>

					<div class="row registration-block">
						<div class="col-sm-6">
							<?= Html::a(
								UserManagementModule::t('front', "Registration"),
								['/user-management/auth/registration']
							) ?>
						</div>
						<div class="col-sm-6 text-right">
							<?= Html::a(
								UserManagementModule::t('front', "Forgot password ?"),
								['/user-management/auth/password-recovery']
							) ?>
						</div>
					</div>

					<?php ActiveForm::end() ?>

					<?php if ($modelPassword != null): ?>

						<div class="password-recovery">

							<?php if ( Yii::$app->session->hasFlash('error') ): ?>
								<div class="alert-alert-warning">
									<?= Yii::$app->session->getFlash('error') ?>
								</div>
							<?php endif; ?>

							<?php $form = ActiveForm::begin([
								'id'=>'user',
								'action' => ['/user-management/auth/password-recovery'],
								'layout'=>'default',
								'validateOnBlur'=>false,
							]); ?>

							<?= $form->field($modelPassword, 'email')->textInput(['maxlength' => 255, 'autofocus'=>true]) ?>

							<?= $form->field($modelPassword, 'captcha')->widget(Captcha::className(), [
								'template' => '<div class="row"><div class="col-sm-4">{image}</div><div class="col-sm-8">{input}</div></div>',
								'captchaAction'=>['/user-management/auth/captcha']
							]) ?>

							<div class="form-group">
									<?= Html::submitButton(
										UserManagementModule::t('front', 'Recover'),
										['class' => 'btn btn-lg btn-primary btn-block']
									) ?>
							</div>

							<?php ActiveForm::end(); ?>

						</div>

				   <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$css = <<<CSS
html, body {
	background: #eee;
	-webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	height: 100%;
	min-height: 100%;
	position: relative;
}
#login-wrapper {
	position: relative;
	top: 30%;
}
#login-wrapper .registration-block .password-recovery {
	margin-top: 15px;
}
CSS;

$this->registerCss($css);
?>