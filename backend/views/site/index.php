<?php

/* @var $this yii\web\View */

$this->title = 'Test';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Hello, <?= Yii::$app->user->identity->username ?>!</h1>
        <p class="lead">Use the top menu in order to create desserts with their ingredients.</p>
    </div>
</div>
