<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 08.08.2016
 * Time: 10:41
 */

namespace PricerBundle\Service\Pricer\FileReader;


interface FileReaderInterface
{
    public function setSettings($stepSize, $startPosition, $encoding = '', $delimiter = '');
    public function getData();
    public function getLastRow();
}