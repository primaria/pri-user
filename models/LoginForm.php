<?php
namespace primaria\user\models;

use Yii;
use yii\base\Model;
use primaria\user\models\User;


/**
 * Login form
 */
class LoginForm extends Model
{

    /** @var string User's email or username */
    public $username;

    /** @var string User's plain password */
    public $password;

    /** @var string Whether to remember the user */
    public $rememberMe = false;


    private $_user = false;


    /**
     * @return array the validation rules.
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

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            //$this->user->updateAttributes(['$last_login' => time()]);
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 300000: 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ( $this->_user === false )
        {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

}
