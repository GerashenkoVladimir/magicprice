<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 29.08.2016
 * Time: 16:08
 */

namespace PricerBundle\Repository;

use Doctrine\ORM\Mapping;
use Doctrine\ORM\EntityRepository;

abstract class AbstractPricerRepository extends EntityRepository
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


    public function clearBy($fieldName, $value)
    {
        return $this->connection->executeUpdate("DELETE FROM {$this->getTableName()} WHERE `$fieldName`=?",
            array($value));
    }

    /**
     * @return string
     */
    abstract protected function getTableName();
}