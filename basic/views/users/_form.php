<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usr_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usr_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
