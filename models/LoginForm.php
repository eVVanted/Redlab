<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;






    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['email'], 'required'],
            ['email', 'email'],

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
//    public function validatePassword($attribute, $params)
//    {
//        if (!$this->hasErrors()) {
//            $user = $this->getUser();
//
//            if (!$user || !$user->validatePassword($this->password)) {
//                $this->addError($attribute, 'Incorrect username or password.');
//            }
//        }
//    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if (!$this->validate()) {
            return null;
        }
        $email = new Email();
        $email->email = $this->email;
        $email->generateToken();

        if(!$email->save()){
            return null;
        }
        $this->sendAuthLink($email);
        return  $email;
    }

    private function sendAuthLink($email)
    {
        Yii::$app->mailer->compose(
            ['html' => 'login-html'],
            ['email' => $email]
        )
            ->setTo($email->email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('To login Folow the link.')
            ->send();
    }







}
