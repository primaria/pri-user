<?php

/*
 * This file is part of the abenavid project.
 *
 * (c) abenavid project <http://github.com/abenavid/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace abenavid\user;

use Yii;
use yii\authclient\Collection;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;
use yii\i18n\PhpMessageSource;

/**
 * Bootstrap class registers module and user application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Bootstrap implements BootstrapInterface
{
    /** @var array Model's map */
    /** @var Mapa de agreglos del modelo */
    private $_modelMap = [
        'User'              => 'abenavid\user\models\User',
        'UserQuery'         => 'abenavid\user\models\UserQuery',
        'SignupForm'        => 'abenavid\user\models\SignupForm',
    ];

    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var User $module */
        /** @var \yii\db\ActiveRecord $modelName */


        if ( $app->hasModule('user') && ($module = $app->getModule('user')) instanceof User)
        {
           // unifica el mapeo de modulos
            $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);

            foreach ($this->_modelMap as $name => $definition) {
                $class = "abenavid\\user\\models\\" . $name;
                Yii::$container->set($class, $definition);
                $modelName = is_array($definition) ? $definition['class'] : $definition;
                $module->modelMap[$name] = $modelName;
                if (in_array($name, ['User', 'Profile', 'Token', 'Account'])) {
                    Yii::$container->set($name . 'Query', function () use ($modelName)
                    {
                        return $modelName::find();
                    });
                }
            }

            Yii::$container->set('yii\web\User', [
                'enableAutoLogin' => true,
                'loginUrl'        => ['/user/default/login'],
                'identityClass'   => $module->modelMap['User'],
            ]);

            if (!isset($app->get('i18n')->translations['user*'])) {
                $app->get('i18n')->translations['user*'] = [
                    'class'    => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                    'sourceLanguage' => 'en-US'
                ];
            }

        }

    }
}
