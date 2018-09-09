<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property int $id
 * @property string $token
 * @property string $email
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['token'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'email' => 'Email',
        ];
    }

    public function generateToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    public static function findByToken($token)
    {
        return static::findOne(['token' => $token]);
    }
}
