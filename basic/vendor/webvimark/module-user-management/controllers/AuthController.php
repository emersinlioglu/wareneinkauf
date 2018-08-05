<?php

namespace webvimark\modules\UserManagement\controllers;

use webvimark\components\BaseController;
use webvimark\modules\UserManagement\components\UserAuthEvent;
use webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm;
use webvimark\modules\UserManagement\models\forms\ConfirmEmailForm;
use webvimark\modules\UserManagement\models\forms\LoginForm;
use webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\KonfigurationUser;
use app\models\Konfiguration;

class AuthController extends BaseController
{
	/**
	 * @var array
	 */
	public $freeAccessActions = ['login', 'logout', 'confirm-registration-email', 'password-recovery', 'password-recovery-receive'];

	/**
	 * @return array
	 */
	public function actions()
	{
		return [
			'captcha' => $this->module->captchaOptions,
		];
	}


	/**
	 * Login form - Prüfen ob, User Konfiguration bestätigt hat
	 *
	 * @return string
	 */
	public function actionLoginKonfiguration($id = null, $zustimmung = null)
	{
		  $konfigurationuser = KonfigurationUser::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['konfiguration_id'=>$id])->one();

          if($konfigurationuser == null && $zustimmung == 1)
          {
	          $konfigurationuser = new KonfigurationUser;
	          $konfigurationuser->user_id = Yii::$app->user->id;
	          $konfigurationuser->konfiguration_id = $id;
	          $konfigurationuser->zustimmung_datum = date("Y-m-d");
	          $konfigurationuser->save();
          }

          $datenow = date('Y-m-d');
          $konfigurationen = Konfiguration::find()->where(['>', 'id', $id])->andWhere(['>=', 'deleted', $datenow])->orderBy(['id'=>SORT_DESC])->all();
          $konfigurationusers = KonfigurationUser::find()->where(['user_id'=>Yii::$app->user->id])->orderBy(['konfiguration_id'=>SORT_DESC])->all();

  	      $konfigurationen_zuordnen = [];
    	

    	  foreach($konfigurationen as $konfiguration)
          {
    		$nichtzugeordnet = true;

        	foreach($konfigurationusers as $kuser)
            {
            	if($konfiguration->id == $kuser->konfiguration_id)
            	{
                    $nichtzugeordnet = false;
            	}
            }


            if($nichtzugeordnet)
            {
            	array_push($konfigurationen_zuordnen, $konfiguration); 
            }

     	  }


          if(count($konfigurationen_zuordnen) > 0)
          {
          	  return $this->renderAjax('konfigurationUser', ['konfigurationen' => $konfigurationen_zuordnen]);
          }

          else
          {
              return $this->redirect(['login']);
          }

	}	


	/**
	 * Login form
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$model = new LoginForm();
		$modelPassword = null;
		$datenow = date('Y-m-d');

		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->login() )
		{
		   $konfigurationuser = KonfigurationUser::find()->where(['user_id'=>Yii::$app->user->id])->orderBy(['konfiguration_id'=>SORT_DESC])->all();

	        if(count($konfigurationuser) == 0)
	        {
	        	$konfigurationen = Konfiguration::find()->where(['>=', 'deleted', $datenow])->orderBy(['id'=>SORT_DESC])->all();

	        	if(count($konfigurationen) > 0)
	        	{

	        		return $this->renderAjax('konfigurationUser', ['konfigurationen' => $konfigurationen]);
	            }
	        }

	        else
	        {
	        	$konfigurationen_zuordnen = [];
	        	$konfigurationen = Konfiguration::find()->where(['>=', 'deleted', $datenow])->orderBy(['id'=>SORT_DESC])->all();

	        	foreach($konfigurationen as $konfiguration)
	        	{
	        		$nichtzugeordnet = true;

		        	foreach($konfigurationuser as $kuser)
		            {
		            	if($konfiguration->id == $kuser->konfiguration_id)
		            	{
                            $nichtzugeordnet = false;
		            	}
		            }

		            if($nichtzugeordnet)
		            {
		            	array_push($konfigurationen_zuordnen, $konfiguration); 
		            }

	        	}

            	if(count($konfigurationen_zuordnen) > 0)
	        	{
	        		return $this->renderAjax('konfigurationUser', ['konfigurationen' => $konfigurationen_zuordnen]);
	            }	  
	        }


		    // set active projekt id in session
            \app\models\User::setActiveProjekt(Yii::$app->request->post('projekt_id'));
			return $this->goBack();
		}


		return $this->renderIsAjax('login', compact('model', 'modelPassword'));
	}

	/**
	 * Logout and redirect to home page
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->redirect(Yii::$app->homeUrl);
	}

	/**
	 * Change your own password
	 *
	 * @throws \yii\web\ForbiddenHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionChangeOwnPassword()
	{
		if ( Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$user = User::getCurrentUser();

		if ( $user->status != User::STATUS_ACTIVE )
		{
			throw new ForbiddenHttpException();
		}

		$model = new ChangeOwnPasswordForm(['user'=>$user]);


		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->changePassword() )
		{
			return $this->renderIsAjax('changeOwnPasswordSuccess');
		}

		return $this->renderIsAjax('changeOwnPassword', compact('model'));
	}

	/**
	 * Registration logic
	 *
	 * @return string
	 */
	public function actionRegistration()
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$model = new $this->module->registrationFormClass;


		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{

			Yii::$app->response->format = Response::FORMAT_JSON;

			// Ajax validation breaks captcha. See https://github.com/yiisoft/yii2/issues/6115
			// Thanks to TomskDiver
			$validateAttributes = $model->attributes;
			unset($validateAttributes['captcha']);

			return ActiveForm::validate($model, $validateAttributes);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
		{
			// Trigger event "before registration" and checks if it's valid
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_REGISTRATION, ['model'=>$model]) )
			{
				$user = $model->registerUser(false);

				// Trigger event "after registration" and checks if it's valid
				if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_REGISTRATION, ['model'=>$model, 'user'=>$user]) )
				{
					if ( $user )
					{
						if ( Yii::$app->getModule('user-management')->useEmailAsLogin AND Yii::$app->getModule('user-management')->emailConfirmationRequired )
						{
							return $this->renderIsAjax('registrationWaitForEmailConfirmation', compact('user'));
						}
						else
						{
							$roles = (array)$this->module->rolesAfterRegistration;

							foreach ($roles as $role)
							{
								User::assignRole($user->id, $role);
							}

							Yii::$app->user->login($user);

							return $this->redirect(Yii::$app->user->returnUrl);
						}

					}
				}
			}

		}

		return $this->renderIsAjax('registration', compact('model'));
	}


	/**
	 * Receive token after registration, find user by it and confirm email
	 *
	 * @param string $token
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionConfirmRegistrationEmail($token)
	{
		if ( Yii::$app->getModule('user-management')->useEmailAsLogin AND Yii::$app->getModule('user-management')->emailConfirmationRequired )
		{
			$model = new $this->module->registrationFormClass;

			$user = $model->checkConfirmationToken($token);

			if ( $user )
			{
				return $this->renderIsAjax('confirmEmailSuccess', compact('user'));
			}

			throw new NotFoundHttpException(UserManagementModule::t('front', 'Token not found. It may be expired'));
		}
	}


	/**
	 * Form to recover password
	 *
	 * @return string|\yii\web\Response
	 */
	public function actionPasswordRecovery()
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		//$model = new PasswordRecoveryForm();
		$modelPassword = new PasswordRecoveryForm();
		$model = new LoginForm();

		if ( Yii::$app->request->isAjax AND $modelPassword->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			// Ajax validation breaks captcha. See https://github.com/yiisoft/yii2/issues/6115
			// Thanks to TomskDiver
			$validateAttributes = $modelPassword->attributes;
			unset($validateAttributes['captcha']);

			return ActiveForm::validate($modelPassword, $validateAttributes);
		}

		if ( $modelPassword->load(Yii::$app->request->post()) AND $modelPassword->validate() )
		{
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_PASSWORD_RECOVERY_REQUEST, ['model'=>$modelPassword]) )
			{
				if ( $modelPassword->sendEmail(false) )
				{
					if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_PASSWORD_RECOVERY_REQUEST, ['model'=>$modelPassword]) )
					{
						return $this->renderIsAjax('passwordRecoverySuccess');
					}
				}
				else
				{
					Yii::$app->session->setFlash('error', UserManagementModule::t('front', "Unable to send message for email provided"));
				}
			}
		}

		//return $this->renderIsAjax('passwordRecovery', compact('model'));
		return $this->renderIsAjax('login', compact('model', 'modelPassword'));
	}

	/**
	 * Receive token, find user by it and show form to change password
	 *
	 * @param string $token
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionPasswordRecoveryReceive($token)
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$user = User::findByConfirmationToken($token);

		if ( !$user )
		{
			throw new NotFoundHttpException(UserManagementModule::t('front', 'Token not found. It may be expired. Try reset password once more'));
		}

		$model = new ChangeOwnPasswordForm([
			'scenario'=>'restoreViaEmail',
			'user'=>$user,
		]);

		if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
		{
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_PASSWORD_RECOVERY_COMPLETE, ['model'=>$model]) )
			{
				$model->changePassword(false);

				if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_PASSWORD_RECOVERY_COMPLETE, ['model'=>$model]) )
				{
					return $this->renderIsAjax('changeOwnPasswordSuccess');
				}
			}
		}

		return $this->renderIsAjax('changeOwnPassword', compact('model'));
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionConfirmEmail()
	{
		if ( Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$user = User::getCurrentUser();

		if ( $user->email_confirmed == 1 )
		{
			return $this->renderIsAjax('confirmEmailSuccess', compact('user'));
		}

		$model = new ConfirmEmailForm([
			'email'=>$user->email,
			'user'=>$user,
		]);

		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
		{
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_EMAIL_CONFIRMATION_REQUEST, ['model'=>$model]) )
			{
				if ( $model->sendEmail(false) )
				{
					if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_EMAIL_CONFIRMATION_REQUEST, ['model'=>$model]) )
					{
						return $this->refresh();
					}
				}
				else
				{
					Yii::$app->session->setFlash('error', UserManagementModule::t('front', "Unable to send message for email provided"));
				}
			}
		}

		return $this->renderIsAjax('confirmEmail', compact('model'));
	}

	/**
	 * Receive token, find user by it and confirm email
	 *
	 * @param string $token
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionConfirmEmailReceive($token)
	{
		$user = User::findByConfirmationToken($token);

		if ( !$user )
		{
			throw new NotFoundHttpException(UserManagementModule::t('front', 'Token not found. It may be expired'));
		}
		
		$user->email_confirmed = 1;
		$user->removeConfirmationToken();
		$user->save(false);

		return $this->renderIsAjax('confirmEmailSuccess', compact('user'));
	}

	/**
	 * Universal method for triggering events like "before registration", "after registration" and so on
	 *
	 * @param string $eventName
	 * @param array  $data
	 *
	 * @return bool
	 */
	protected function triggerModuleEvent($eventName, $data = [])
	{
		$event = new UserAuthEvent($data);

		$this->module->trigger($eventName, $event);

		return $event->isValid;
	}
}
