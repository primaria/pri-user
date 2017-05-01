<?php
namespace primaria\user\models;

use yii\base\Model;
use primaria\user\models\User;


/**
 * Signup form
 *
 * @property string $username
 * @property string $email
 * @property string $password
 */
class SignupForm extends Model
{
    public $username;
    public $email;
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

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
