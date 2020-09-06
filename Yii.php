<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

require __DIR__ . '/BaseYii.php';

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Yii extends \yii\BaseYii
{

    public static function applicationDispatcher($config){

        $routeStr = ltrim($_GET["r"],'/');

        if (!$routeStr){
            return (new yii\web\Application($config))->run();
        }

        $routeArr = explode('/',$routeStr);

        //分组
        $group = array_shift($routeArr);

        $_GET["r"] = implode('/',$routeArr);

        switch ($group){
            case "api":
                return (new yii\api\Application($config))->run();
                break;
            case "admin":
                return (new yii\web\Application($config))->run();
                break;
            default:
                return (new yii\web\Application($config));
        }
    }
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require __DIR__ . '/classes.php';
Yii::$container = new yii\di\Container();
