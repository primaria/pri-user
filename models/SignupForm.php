<?php
/*
 * Este Archivo es parte del proyecto Primaria
 *
 * (c) Primaria project <http://github.com/primaria/>
 *
 */


namespace primaria\user\models;

use Yii;
use yii\base\Model;

use primaria\user\traits\ModuleTrait;

/**
 * Signup form
 *
 * @property string $username
 * @property string $email
 * @property string $password
 */
class SignupForm extends Model
{
    use ModuleTrait;

    /**
     * @var string Username
     */
    public $username;

    /**
     * @var string User email address
     */
    public $email;

    /**
     * @var string Password
     */
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {


        return [
            ['username', 'trim'],
            ['username', 'required'],
       //     ['username', 'unique', 'targetClass' => 'abenavid\users\models\Users', 'message' => 'This username has already been taken.'],
       //     ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
       //     ['email', 'string', 'max' => 255],
       //     ['email', 'unique', 'targetClass' => 'abenavid\users\models\Users', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 3],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        return true;

    }

    /**
     * Loads attributes to the user model. You should override this method if you are going to add new fields to the
     * registration form. You can read more in special guide.
     *
     * By default this method set all attributes of this model to the attributes of User model, so you should properly
     * configure safe attributes of your User model.
     *
     * @param User $user
     */
    protected function loadAttributes(User $user)
    {
        $user->setAttributes($this->attributes);
    }
}
