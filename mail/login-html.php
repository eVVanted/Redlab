<?php
use yii\helpers\Html;


$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['auth', 'token' => $email->token]);
?>
<div class="login-link">
    <p>Hello <?= Html::encode($email->email) ?>,</p>

    <p>Follow the link below to reset your password:</p>

    <p><?= Html::a(Html::encode($loginLink), $loginLink) ?></p>
</div>
