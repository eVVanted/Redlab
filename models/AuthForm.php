<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 08.09.2018
 * Time: 18:28
 */

namespace app\models;


use Yii;
use yii\base\Model;


class AuthForm extends Model
{
    public $token;
    private $_email = false;
    private $_user = false;




    public function getEmail()
    {
        if ($this->_email === false) {
            $email = Email::findByToken($this->token);
            $this->_email = $email->email;
            $email->delete();
        }

        return $this->_email;
    }
    public function auth()
    {
        if (!$this->getEmail()) {
            return null;
        }
        if($this->getUser()){
            return Yii::$app->user->login($this->_user, 0);
        }

        $user = new User;
        $user->email = $this->_email;
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->created_at = time();
        $user->updated_at = time();
        $user->save();
        return Yii::$app->user->login($user, 0);
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->_email);
        }
        return $this->_user;
    }



}