<?php

namespace PricerBundle\Entity;

use PricerBundle\Service\Pricer\DataHandler\DataInterface\OriginalPriceListInterface;
use PricerBundle\Service\Pricer\DataHandler\DataInterface\ReadyPriceListInterface;


/**
 * OriginalPriceList
 */
class OriginalPriceList
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $vendorCode;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var \PricerBundle\Entity\PriceList
     */
    private $priceList;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vendorCode
     *
     * @param string $vendorCode
     *
     * @return OriginalPriceList
     */
    public function setVendorCode($vendorCode)
    {
        $this->vendorCode = $vendorCode;

        return $this;
    }

    /**
     * Get vendorCode
     *
     * @return string
     */
    public function getVendorCode()
    {
        return $this->vendorCode;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return OriginalPriceList
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OriginalPriceList
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return OriginalPriceList
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return OriginalPriceList
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set priceList
     *
     * @param \PricerBundle\Entity\PriceList $priceList
     *
     * @return OriginalPriceList
     */
    public function setPriceList(\PricerBundle\Entity\PriceList $priceList)
    {
        $this->priceList = $priceList;

        return $this;
    }

    /**
     * Get priceList
     *
     * @return \PricerBundle\Entity\PriceList
     */
    public function getPriceList()
    {
        return $this->priceList;
    }
    /**
     * @var float
     */
    private $price;

    /**
     * @var \PricerBundle\Entity\User
     */
    private $user;


    /**
     * Set price
     *
     * @param float $price
     *
     * @return OriginalPriceList
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set user
     *
     * @param \PricerBundle\Entity\User $user
     *
     * @return OriginalPriceList
     */
    public function setUser(\PricerBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PricerBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \PricerBundle\Entity\ReadyPriceList
     */
    private $readyPriceList;


    /**
     * Set readyPriceList
     *
     * @param \PricerBundle\Entity\ReadyPriceList $readyPriceList
     *
     * @return OriginalPriceList
     */
    public function setReadyPriceList(\PricerBundle\Entity\ReadyPriceList $readyPriceList = null)
    {
        $this->readyPriceList = $readyPriceList;

        return $this;
    }

    /**
     * Get readyPriceList
     *
     * @return \PricerBundle\Entity\ReadyPriceList
     */
    public function getReadyPriceList()
    {
        return $this->readyPriceList;
    }

    public function setChild(ReadyPriceListInterface $readyPriceList)
    {
        $this->setReadyPriceList($readyPriceList);        
    }


}
