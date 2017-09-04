<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UsersRecord;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AccountsRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal fade" id="modalAddAccountForm" tabindex="-1" role="dialog" aria-labelledby="addAccountAjaxForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addAccountAjaxForm">Add Account</h4>
            </div>
            <div class="modal-body">

                <?php $form = ActiveForm::begin(['options' => ['data-model' => 'accounts']]); ?>

                <?= $form->field($model, 'account')->textInput() ?>

                <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(UsersRecord::find()->all(), 'id', 'usr_name')) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
