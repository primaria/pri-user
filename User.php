<?php
namespace primaria\user;

/*
 * This file is part of the Primaria user.
 *
 * (c) Primaria project <http://github.com/primaria/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */




use yii\base\Module as BaseModule;

/**
 * User module definition class
 */
class User extends BaseModule
{
    const VERSION = '0.1.0';

    /** Email is changed right after user enter's new email address. */
    const STRATEGY_INSECURE = 0;

    /** Email is changed after user clicks confirmation link sent to his new email address. */
    const STRATEGY_DEFAULT = 1;

    /** Email is changed after user clicks both confirmation links sent to his old and new email addresses. */
    const STRATEGY_SECURE = 2;

    /** @var bool Whether to show flash messages. */
    public $enableFlashMessages = true;

    /** @var bool Whether to enable registration. */
    public $enableRegistration = true;

    /** @var bool Whether to remove password field from registration form. */
    public $enableGeneratingPassword = false;

    /** @var bool Whether user has to confirm his account. */
    public $enableConfirmation = true;

    /** @var bool Whether to allow logging in without confirmation. */
    public $enableUnconfirmedLogin = false;

    /** @var bool Whether to enable password recovery. */
    public $enablePasswordRecovery = true;

    /** @var bool Whether user can remove his account */
    public $enableAccountDelete = false;

    /** @var int Email changing strategy. */
    public $emailChangeStrategy = self::STRATEGY_DEFAULT;

    /** @var int The time you want the user will be remembered without asking for credentials. */
    public $rememberFor = 1209600; // two weeks

    /** @var int The time before a confirmation token becomes invalid. */
    public $confirmWithin = 86400; // 24 hours

    /** @var int The time before a recovery token becomes invalid. */
    public $recoverWithin = 21600; // 6 hours

    /** @var int Cost parameter used by the Blowfish hash algorithm. */
    public $cost = 10;

    /** @var array An array of administrator's usernames. */
    public $admins = [];

    /** @var string The Administrator permission name. */
    public $adminPermission;

    /** @var array Mailer configuration */
    public $mailer = [];

    /** @var array Model map */
    public $modelMap = [];

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */

    /**
     * @var bool Is the user module in DEBUG mode? Will be set to false automatically
     * if the application leaves DEBUG mode.
     */
    public $debug = TRUE;

    /**
     * Get module version
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    public $urlPrefix = 'user';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
//         '<id:\d+>'                               => 'profile/show',
         '<action:(login|logout)>'                => 'login/<action>',
//         '<action:(register|resend)>'             => 'registration/<action>',
//         'confirm/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'registration/confirm',
//         'forgot'                                 => 'recovery/request',
//         'recover/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'recovery/reset',
//         'settings/<action:\w+>'                  => 'settings/<action>'
    ];

}

