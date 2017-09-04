<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersRecord */

$this->title = 'Update Users Record: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
