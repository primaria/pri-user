<?php

/*
 * Este archivo es parte de Primaria project
 *
 * (c) Primaria project
 *
 */

namespace primaria\user;

use yii\base\Module as BaseModule;

/**
 * Este es el inicio del modulo pri-user.
 *
 * @property array $modelMap
 *
 * @author Primaria TI
 */
class User extends BaseModule
{
    const VERSION = '0.1.0';

    /** El Email se cambia justo después de que el usuario ingrese Email */
    const STRATEGY_INSECURE = 0;

    /** El email se cambia despues de hacer clic al enlace de confirmacion enviado al nuevo email. */
    const STRATEGY_DEFAULT = 1;

    /** El email de cambia despues de hacer clic al enlace del correo nuevo y el antiguo */
    const STRATEGY_SECURE = 2;

    /** @var bool Si se desea mostrar mensajes flash. */
    public $enableFlashMessages = true;

    /** @var bool habilita el registro de usuarios. */
    public $enableRegistration = true;

    /** @var bool Habilita auto generacion de la password y elimina el campo en el registro. */
    public $enableGeneratingPassword = FALSE;

    /** @var bool envia confirmacion por email de nuevos usuarios. */
    public $enableConfirmation = true;

    /** @var bool Permite inicio de session sin confirmacion. */
    public $enableUnconfirmedLogin = false;

    /** @var bool Permite restablecer la password. */
    public $enablePasswordRecovery = true;

    /** @var bool Permite que el usuario elimine su cuenta */
    public $enableAccountDelete = false;

    /** @var bool Habilitar la función 'suplantar como otro usuario' */
    public $enableImpersonateUser = true;

    /** @var int Estrategia de cambio de correo electrónico. */
    public $emailChangeStrategy = self::STRATEGY_DEFAULT;

    /** @var int El tiempo que desea que el usuario será recordado. */
    public $rememberFor = 1209600; // two weeks

    /** @var int El tiempo antes de que un token de confirmación se vuelva inválido. */
    public $confirmWithin = 86400; // 24 hours

    /** @var int El tiempo antes de que un token de recuperacion de password se vuelva inválido. */
    public $recoverWithin = 21600; // 6 hours

    /** @var int Cost parameter used by the Blowfish hash algorithm. */
    public $cost = 10;

    /** @var array An array of administrator's usernames. */
    public $admins = [];

    /** @var string El nombre del permiso de administrador. */
    public $adminPermission;

    /** @var array Mailer configuration */
    public $mailer = [];

    /** @var array Model map */
    public $modelMap = [];

    /**
     * @var string El prefijo para la URL de user Module.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'user';

    /**
     * @var bool Is the user module in DEBUG mode? Will be set to false automatically
     * if the application leaves DEBUG mode.
     */
    public $debug = FALSE;

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        '<id:\d+>'                               => 'profile/show',
        '<action:(login|logout|auth)>'           => 'security/<action>',
        '<action:(register|resend)>'             => 'registration/<action>',
        'confirm/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'registration/confirm',
        'forgot'                                 => 'recovery/request',
        'recover/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'recovery/reset',
        'settings/<action:\w+>'                  => 'settings/<action>'
    ];
}
