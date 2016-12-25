<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 12.08.2016
 * Time: 15:29
 */

namespace PricerBundle\Service\Pricer\FileWriter\Writer;


use PricerBundle\Service\Pricer\FileWriter\FileWriterInterface;

class CSV implements FileWriterInterface
{
    private $phpExcel;
    private $fileName;
    private $fileType;

    public function __construct($fileName, $fileType)
    {
        $this->fileName = $fileName;
        $this->fileType = $fileType;
        $this->phpExcel = new \PHPExcel();
    }

    public function save(array $data)
    {
        $f = fopen($this->fileName, 'a');
        if (!empty($f)) {
            $content = "";
//            $counter = 1;
            foreach ($data as $row) {
                $content .= "\xEF\xBB\xBF" . implode(';', $row) . /*";;;;; $counter;" .*/ "\n";
//                $counter++;
            }
            fwrite($f, $content);
            fclose($f);
        }
        /*$workSheet = $this->phpExcel->getActiveSheet();
        $rowCounter = 1;
        foreach ($data as $row) {
            $columnCounter = 0;
            foreach ($row as $cell){
//                if (mb_detect_encoding($cell) == "UTF-8"){
//                    $cell = iconv("UTF-8", "CP1251//TRANSLIT", $cell);
//                }
                $workSheet->setCellValueByColumnAndRow($columnCounter, $rowCounter, $cell);
                $columnCounter++;
            }
            $rowCounter++;
        }
        
        $writer = \PHPExcel_IOFactory::createWriter($this->phpExcel, 'CSV');
        $writer->setUseBOM(true);
        $writer->save($this->fileName);*/
    }
}