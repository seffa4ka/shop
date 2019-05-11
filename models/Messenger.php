<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * This is the model class for table "messenger".
 *
 * @property int $id
 * @property int $users_id
 * @property int $is_delivered
 * @property int $ts_create
 *
 * @property User $users
 */
class Messenger extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messenger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['users_id', 'is_delivered', 'ts_create'], 'required'],
            [['users_id', 'is_delivered', 'ts_create'], 'integer'],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['users_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => 'Users ID',
            'is_delivered' => 'Is Delivered',
            'ts_create' => 'Ts Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::class, ['id' => 'users_id']);
    }
}
