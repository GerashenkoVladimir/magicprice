<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 08.08.2016
 * Time: 10:05
 */

namespace PricerBundle\Service\Pricer;

use PricerBundle\Service\Pricer\DataHandler\DataHandler;
use PricerBundle\Service\Pricer\DataHandler\DataInterface\DataHandlerInterface;
use PricerBundle\Service\Pricer\FileWriter\FileWriterInterface;
use PricerBundle\Service\Pricer\FileWriter\Writer\CSV as CSVWriter;
use PricerBundle\Service\Pricer\FileReader\Reader\CSV as CSVReader;

class Pricer
{
    private static $handlerBag = array(
        'common' => DataHandler::class
    );

    private static $writersBag = array(
        'csv' => CSVWriter::class
    );

    private static $readersBag = array(
        'csv' => CSVReader::class
    );

    public static function getReader($fileName, $fileType)
    {
        return self::createObject(mb_strtolower($fileType), self::$readersBag, array(
            $fileName,
        ));
    }

    /**
     * @param string $handler
     * @param array $arguments
     * @return null|DataHandlerInterface
     */
    public static function getDataHandler($handler = 'common', $arguments = array())
    {
        return self::createObject($handler, self::$handlerBag, $arguments);
    }


    /**
     * @param $fileName
     * @param $fileType
     * @return null|FileWriterInterface
     */
    public static function getWriter($fileName, $fileType)
    {
        return self::createObject(mb_strtolower($fileType), self::$writersBag, array(
            $fileName,
            $fileType
        ));
    }

    private static function createObject($key, $bag, $arguments = array())
    {
        if (key_exists($key, $bag)) {
            if (class_exists($bag[$key])) {
                $refObject = new \ReflectionClass($bag[$key]);
                return $refObject->newInstanceArgs($arguments);

            }
        }
        return null;
    }
}