<?php
namespace primaria\user;




use yii\base\Module as BaseModule;

/**
 * User module definition class
 */
class User extends BaseModule
{
    protected $version = "0.1.0";



    /** @var bool Activa la opcion de registro
     * True, muestra la opcion de registro
     * false, oculta la opcion de registro*/
    public $enableRegistration = true;

    /** @var bool Activa la recuperacion de la password
     * True, autoriza la recuperacion de la password
     * false, no autoriza la recuperacion de la password */
    public $enablePasswordRecovery = TRUE;

    /** @var int Tiempo que el usuario sea recordado sin pedir credenciales */
    public $rememberTime = 1209600; // two weeks


    /** @var array An array of administrator's usernames. */
    public $admins = [];

    /** @var string The Administrator permission name. */
    public $adminPermission;

    /** @var array Mailer configuration */
    public $mailer = [];

    /** @var array Model map */
    public $modelMap = [];



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
    ];

}

