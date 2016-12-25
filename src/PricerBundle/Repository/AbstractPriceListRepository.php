<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 20.08.2016
 * Time: 15:30
 */

namespace PricerBundle\Repository;

use Doctrine\ORM\Mapping;

abstract class AbstractPriceListRepository extends AbstractPricerRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->connection = $this->getEntityManager()->getConnection();

    }

    abstract public function multipleInsert(array $data, array $params, array $priceSettings, $toClean = true);
}