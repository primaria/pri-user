<?php
namespace primaria\user\models;

use Yii;
use yii\base\Model;
use primaria\user\User;
use primaria\user\traits\ModuleTrait;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;

    /** @var \primaria\user\models\User */
    protected $user;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'username'   => Yii::t('user', 'Username'),
            'password'   => Yii::t('user', 'Password'),
            'rememberMe' => Yii::t('user', 'Remember me'),
        ];
    }

    /**
     * Validates if the hash of the given password is identical to the saved hash in the database.
     * It will always succeed if the module is in DEBUG mode.
     *
     * @return void
     */
    public function validatePassword($attribute, $params)
    {
      if ($this->user === null || !Password::validate($this->password, $this->user->password_hash))
        $this->addError($attribute, Yii::t('user', 'Invalid login or password'));
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {

        if ($this->validate()) {

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? $this->module->rememberTime : 0);

            //return Yii::$app->user->logins($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);

        } else {
            return false;
        }
    }


}
