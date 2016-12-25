<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 12.08.2016
 * Time: 15:20
 */

namespace PricerBundle\Service\Pricer\FileWriter;


interface FileWriterInterface
{
    public function save(array $data);
}