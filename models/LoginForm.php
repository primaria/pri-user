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

    /**
     * Esta variable Registra si ya ingraso antes el usuario
     *
     * @var boolen
     */
    private $_user = false;

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'username'   => \Yii::t('user', 'Username'),
            'password'   => \Yii::t('user', 'Password'),
            'rememberMe' => \Yii::t('user', 'Remember me'),
        ];
    }


    /**
     * Establece las reglas de validacion para el formulario login
     *
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username y password son requeridos
            [['username', 'password'], 'required'],
            // rememberMe debe ser un valor booleano
            ['rememberMe', 'boolean'],
            // El password es validado por el metodo validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validación del password.
     * Este método sirve como validación en de la contraseña.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('user', 'Invalid login or password'));
            }
        }
    }

    /**
     * Este metodo valida el [username] ingrasado en la BD y asigna un tiempo de conexion
     *
     * @return unknown|boolean
     */
    public function login()
    {
        if ($this->validate()) {
            //$this->user->updateAttributes(['$last_login' => time()]);
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3000 : 0);
        }
        return false;
    }

    /**
     * Busca usuario por [[username]]
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
