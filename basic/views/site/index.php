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

    <!-- Кнопки вызова форм для добавления пользователей и аккаунтов -->
    <p id="form-loaders">
        <?= Html::a('Add New User', ['users/create'], ['data-model' => 'users', 'class' => 'btn btn-success']) ?>
        <?= Html::a('Add New Account', ['accounts/create'], ['data-model' => 'accounts','class' => 'btn btn-success']) ?>
    </p>

    <!-- Начало обновляемого через Ajax блока  -->
    <?php Pjax::begin(['id' => 'accounts']); ?>

        <!-- Вывод таблицы с информацией об аккаунтах  -->
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
        <!-- Конец таблицы с информацией об аккаунтах  -->

    <?php Pjax::end(); ?>
    <!-- Конец обновляемого через Ajax блока  -->
</div>
<script>
    $(function ()
    {
        //Обработка нажатия кнопки вызова формы добавления пользователя
        $('#form-loaders').on('click', 'button', function (e)
        {
            e.stopPropagation();
            var model = $(this).data('model');

            //Загружаем форму
            $.get('/' + model + '/ajax-create', function(response)
            {
                $('body').append(response); //Добавляем на страницу
                $('.modal').modal(); //Запускаем модальное окно с загруженной формой
            });

            return false;
        });

        // Обработчик закрытия модального окна с загруженной формой
        $(document).on('click', '.modal .close', function ()
        {
            var modal = $(this).closest('.modal');
            setTimeout(function ()
            {
                modal.remove();
            }, 1000);
        });

        // Обработчик выполнения загруженной формы
        $(document).on('submit', '.modal form', function (e)
        {
            e.stopPropagation();

            var form = $(this);

            // Убираем предыдущие сообщения об ошибках
            form.find('.has-error').find('.help-block').empty();
            form.find('.has-error').removeClass('has-error');

            var model = form.data('model');

            // Отправляем данные формы через Ajax POST запрос
            $.post(model + '/ajax-create', $(this).serialize())
                .success(function (data)
                {
                    if ('errors' in data)
                    { // Если есть ошибки выводим их в форме и прерываем обработчик
                        if (Object.keys(data.errors).length > 0)
                        {
                            for (i in data.errors)
                            {
                                form.find('.field-' + model + 'record-' + i).addClass('has-error');
                                form.find('.field-' + model + 'record-' + i).find('.help-block').text(data.errors[i][0]);
                            }

                            return false;
                        }

                        // Перезагружаем таблицу
                        $.pjax.reload({container: "#accounts", url: "/"});

                        // Закрываем модальное окно с формой
                        form.closest('.modal').find('.close').click();
                    }
                });

            return false;
        });

    });
</script>