<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $usr_name
 * @property string $usr_email
 * @property string $usr_address
 *
 * @property AccountsRecord[] $accounts
 */
class UsersRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usr_name', 'usr_email'], 'required'],
            [['usr_name', 'usr_email', 'usr_address'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usr_name' => 'User Name',
            'usr_email' => 'User Email',
            'usr_address' => 'User Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(AccountsRecord::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList()
    {
        $users = self::find()->all();
        return ArrayHelper::map($users, 'user_id', 'usr_name');
    }
}
