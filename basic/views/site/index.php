<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountsRecordSearch */
/* @var $dataProvider  */
/* @var $usrNameFilter  */
/* @var $usrEmailFilter  */
/* @var $usrAddressFilter  */

$this->title = 'Test Application';
?>
<div class="accounts-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add New User', ['users/create'], ['id' => 'add-user', 'class' => 'btn btn-success']) ?>
        <?= Html::a('Add New Account', ['accounts/create'], ['id' => 'add-account','class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['id' => 'accounts']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'usr_name',
                'label'=>'User Name',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->user->usr_name;
                },
                'filter' => $usrNameFilter
            ],
            [
                'attribute'=>'usr_email',
                'label'=>'User Email',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->user->usr_email;
                },
                'filter' => $usrEmailFilter
            ],
            [
                'attribute'=>'usr_address',
                'label'=>'User Address',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->user->usr_address;
                },
                'filter' => $usrAddressFilter
            ],
            'account',
            [
                'attribute'=>'added',
                'format'=>'datetime',
                'headerOptions' => ['width' => '250'],
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'added_from',
                    'attributeTo' => 'added_to',
                    'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-M-yyyy'
                    ]
                ])
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<script>
    $(function ()
    {
        $('#add-user').on('click', function (e)
        {
            e.stopPropagation();
            $.get('/users/ajax-create', function(response)
            {
                $('body').append(response);
                $('.modal').modal();
            });

            return false;
        });

        $('#add-account').on('click', function (e)
        {
            e.stopPropagation();
            $.get('/accounts/ajax-create', function(response)
            {
                $('body').append(response);
                $('.modal').modal();
            });

            return false;
        });

        $(document).on('click', '.modal .close', function ()
        {
            var modal = $(this).closest('.modal');
            setTimeout(function ()
            {
                modal.remove();
            }, 1000);
        });

        $(document).on('submit', '.modal form', function (e)
        {
            e.stopPropagation();

            var form = $(this);
            form.find('.has-error').find('.help-block').empty();
            form.find('.has-error').removeClass('has-error');

            var model = form.data('model');
            $.post(model + '/ajax-create', $(this).serialize())
                .success(function (data) {
                    if ('errors' in data)
                    {
                        if (Object.keys(data.errors).length > 0)
                        {
                            for (i in data.errors)
                            {
                                form.find('.field-' + model + 'record-' + i).addClass('has-error');
                                form.find('.field-' + model + 'record-' + i).find('.help-block').text(data.errors[i][0]);
                            }

                            return false;
                        }

                        $.pjax.reload({container: "#accounts", url: "/"});

                        form.closest('.modal').find('.close').click();
                    }
                });

            return false;
        });

    });
</script>