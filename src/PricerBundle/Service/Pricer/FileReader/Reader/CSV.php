<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 08.08.2016
 * Time: 10:43
 */

namespace PricerBundle\Service\Pricer\FileReader\Reader;

use PricerBundle\Service\Pricer\FileReader\FileReaderInterface;

class CSV implements FileReaderInterface
{
    protected $stepSize;

    protected $startPosition;
    
    protected $fileName;

    protected $delimiter;

    protected $encoding;

    protected $lastRow;
    

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getData()
    {
        $file = file($this->fileName);
        $this->lastRow = count($file);
        $rows = array();
        if (($endPosition = $this->startPosition + $this->stepSize) > $this->lastRow) {
            $endPosition = $this->lastRow;
        }
        for ($i = $this->startPosition; $i < ($endPosition); $i++) {
            $row = $this->replaceSemicolon(iconv($this->encoding, "UTF-8//TRANSLIT", $file[$i]));
            $rows[] = explode($this->delimiter, $row);
        }
        return $rows;
    }

    public function setSettings($stepSize, $startPosition, $encoding = 'CP1251', $delimiter = ';')
    {
        $this->stepSize = $stepSize;
        $this->startPosition = $startPosition;
        $this->encoding = $encoding;
        $this->delimiter = $delimiter;

    }

    public function getLastRow()
    {
        return $this->lastRow;
    }

    private function replaceSemicolon($str)
    {
        return preg_replace_callback('|"([\w\W]+)"|', function ($matches) {
            return preg_replace('|;|', '', $matches[0]);
        }, $str);
    }
}