<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountsRecord */

$this->title = 'Create Accounts Record';
$this->params['breadcrumbs'][] = ['label' => 'Accounts Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
