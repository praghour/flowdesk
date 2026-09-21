<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fullname
 * @property string $login
 * @property string $password
 * @property string $phone
 * @property string $email
 * @property int $role
 * @property string $created_at
 *
 * @property Comment[] $comments
 * @property Request[] $requests
 */
class User extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 0],
            [['fullname', 'login', 'password', 'phone', 'email'], 'required'],
            [['role'], 'integer'],
            [['created_at'], 'safe'],
            [['fullname'], 'string', 'max' => 150],
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 100],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'login' => 'Login',
            'password' => 'Password',
            'phone' => 'Phone',
            'email' => 'Email',
            'role' => 'Role',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['user_id' => 'id']);
    }

}
