<?php
namespace primaria\user\models;

use primaria\user\find\findAuth;
use Yii;
use yii\base\Model;
use primaria\user\mail\sendMail;

/**
 * Password reset request form
 */
class RecoveryForm extends Model
{
    const SCENARIO_REQUEST = 'request';
    const SCENARIO_RESET = 'reset';

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;


    /**
     * @var findAuth
     */
    protected $findAuth;

    /**
     * @var SendMail
     */
    protected $sendMail;

    /**
     * @param SendMail $sendMail
     * @param findAuth $findAuth
     * @param array  $config
     */
    public function __construct(SendMail $sendMail, findAuth $findAuth, $config = [])
    {
        $this->sendMail = $sendMail;
        $this->findAuth = $findAuth;
        parent::__construct($config);
    }


    public function attributeLabels()
    {
        return [
            'email'    => \Yii::t('user', 'Email'),
            'password' => \Yii::t('user', 'Password'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_REQUEST => ['email'],
            self::SCENARIO_RESET => ['password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'emailTrim' => ['email', 'filter', 'filter' => 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'passwordRequired' => ['password', 'required'],
            'passwordLength' => ['password', 'string', 'max' => 72, 'min' => 6],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {

        if (!$this->validate()) {
            return false;
        }

        /* @var $user User */

        $user = $this->findAuth->findUserByEmail($this->email);


        if ($user instanceof User) {
            /** @var Token $token */
            $token = \Yii::createObject([
                'class' => Token::className(),
                'user_id' => $user->id,
                'type' => Token::TYPE_RECOVERY,
            ]);

            if (!$token->save(false)) {
                return false;
            }

            if (!$this->sendMail->sendRecoveryMessage($user, $token)) {
                return false;
            }


        }



    }
}
