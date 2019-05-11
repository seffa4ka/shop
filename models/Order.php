<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $users_id
 * @property int $products_id
 * @property string $status
 * @property int $ts_update
 * @property int $ts_create
 *
 * @property Products $products
 * @property User $users
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['users_id', 'products_id', 'status', 'ts_update', 'ts_create'], 'required'],
            [['users_id', 'products_id', 'ts_update', 'ts_create'], 'integer'],
            [['status'], 'string'],
            [['products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['products_id' => 'id']],
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
            'products_id' => 'Products ID',
            'status' => 'Status',
            'ts_update' => 'Ts Update',
            'ts_create' => 'Ts Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Product::class, ['id' => 'products_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::class, ['id' => 'users_id']);
    }
}
