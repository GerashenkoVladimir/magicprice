<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 08.08.2016
 * Time: 10:10
 */

namespace PricerBundle\Service\Pricer\FileReader;


use PricerBundle\Service\Pricer\FileReader\Reader\CSV;

class FileReader
{
    private static $formatBag = array(
        'CSV' => 'createCSVReader',
    );

    /**
     * 
     * @param $fileName
     * @param $fileType
     * @return FileReaderInterface|bool
     */
    public static function getReader($fileName, $fileType)
    {
        if (key_exists($fileType, self::$formatBag)) {
            $methodName = self::$formatBag[$fileType];
            return self::$methodName($fileName, $fileType);
        }
        
        return false;
    }

    /**
     * @param $fileName
     * @param $fileType
     * @return CSV
     */
    private static function createCSVReader($fileName, $fileType)
    {
        return new CSV($fileName, $fileType);
    }
}