<?php

namespace frontend\models;

use common\models\FrontendUser;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class FrontendLoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Logs in a user using the provided phone
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[phone]]
     *
     * @return FrontendUser|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = FrontendUser::findByEmail($this->email);
        }

        return $this->_user;
    }
}
