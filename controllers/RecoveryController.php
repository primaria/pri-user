<?php
namespace primaria\user\models;


use Yii;
use yii\base\Model;
use primaria\user\mail\sendMail;
use primaria\user\find\findAuth;

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



}
