<?php


namespace primaria\user\traits;

use primaria\user\Module;

/**
 * Trait ModuleTrait
 * @property-read Module $module
 * @package primaria\user\traits
 */
trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('user');
    }
}
