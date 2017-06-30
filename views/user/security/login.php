<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$css = <<<CSS
.checkbox label {
    display: block;
}
CSS;

$this->registerCss($css);

$authClients = Yii::$app->get('authClientCollection')->getClients();

?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<?php $form = ActiveForm::begin([
    'id'                     => 'login-form',
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false,
    'validateOnBlur'         => false,
    'validateOnType'         => false,
    'validateOnChange'       => false,
]) ?>

	<div class="form-group has-feedback">
		<?= $form->field(
            $model,
            'login',
            [
                'template' => "{input}\n{error}",
                'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'placeholder' => Yii::t('user', 'Username')],
                'options' => ['tag' => false]
            ]
        ) ?>
		<span class="glyphicon glyphicon-user form-control-feedback"></span>
	</div>

	<div class="form-group has-feedback">
		<?= $form->field(
            $model,
            'password',
            [
                'template' => "{input}\n{error}",
                'inputOptions' => ['class' => 'form-control', 'tabindex' => '2', 'placeholder' => Yii::t('user', 'Password')],
                'options' => ['tag' => false]
            ]
		)->passwordInput() ?>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>

	<div class="row">
		<div class="col-xs-8">
			<div class="checkbox">
				<?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>
			</div>
		</div>
		<div class="col-xs-4">
			<?= Html::submitButton(
                    Yii::t('user', 'Sign in'),
                    ['class' => 'btn btn-primary btn-block btn-flat', 'tabindex' => '3']
             ) ?>
		</div>
	</div>
<?php ActiveForm::end() ?>

<?php if (!empty($authClients)): ?>
<div class="social-auth-links text-center">
	<p>- OR -</p>
	<?= Connect::widget([
            'baseAuthUrl' => ['/user/security/auth'],
    ]) ?>
</div>
<?php endif ?>

<?php if ($module->enablePasswordRecovery): ?>
<?= Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request']) ?>
<?php endif ?>

<?php if ($module->enableConfirmation): ?>
<br><?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
<?php endif ?>

<?php if ($module->enableRegistration): ?>
<br><?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
<?php endif ?>

