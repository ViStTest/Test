<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal fade" id="modalAddUserForm" tabindex="-1" role="dialog" aria-labelledby="addUserAjaxForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addUserAjaxForm">Add User</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['options' => ['data-model' => 'users']]); ?>

                <?= $form->field($model, 'usr_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'usr_email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'usr_address')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
