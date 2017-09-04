<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UsersRecord;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AccountsRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(UsersRecord::find()->all(), 'id', 'usr_name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
