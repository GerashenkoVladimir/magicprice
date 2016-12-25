<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 09.07.2016
 * Time: 12:32
 */

namespace PricerBundle\Service;


use Symfony\Component\HttpKernel\Kernel;

class GlobalHelper
{
    /**
     * @var Kernel
     */
    private static $kernel;

    /**
     * @var array
     */
    private static $priceSettingsConfig;

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public static function getContainer()
    {
        return self::$kernel->getContainer();
    }

    /**
     * @param Kernel $kernel
     */
    public static function setKernel(Kernel $kernel)
    {
        self::$kernel = $kernel;
    }

    public static function getPriceSettingsConfig()
    {
        if (!isset(self::$priceSettingsConfig))
        {
            self::$priceSettingsConfig = require_once __DIR__ . '/../Resources/config/custom/price_list_settings_fields.php';
        }
        
        return self::$priceSettingsConfig;
        
    }
}