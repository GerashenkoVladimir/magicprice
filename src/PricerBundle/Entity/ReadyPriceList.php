<?php

namespace PricerBundle\Entity;

use PricerBundle\Service\Pricer\DataHandler\DataInterface\OriginalPriceListInterface;
use PricerBundle\Service\Pricer\DataHandler\DataInterface\ReadyPriceListInterface;


/**
 * ReadyPriceList
 */
class ReadyPriceList
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
     * @var float
     */
    private $price;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var \PricerBundle\Entity\OriginalPriceList
     */
    private $originalPriceList;

    /**
     * @var \PricerBundle\Entity\User
     */
    private $user;

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
     * @return ReadyPriceList
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
     * @return ReadyPriceList
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
     * @return ReadyPriceList
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
     * @return ReadyPriceList
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
     * Set price
     *
     * @param float $price
     *
     * @return ReadyPriceList
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return ReadyPriceList
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
     * Set originalPriceList
     *
     * @param \PricerBundle\Entity\OriginalPriceList $originalPriceList
     *
     * @return ReadyPriceList
     */
    public function setOriginalPriceList(\PricerBundle\Entity\OriginalPriceList $originalPriceList = null)
    {
        $this->originalPriceList = $originalPriceList;

        return $this;
    }

    /**
     * Get originalPriceList
     *
     * @return \PricerBundle\Entity\OriginalPriceList
     */
    public function getOriginalPriceList()
    {
        return $this->originalPriceList;
    }

    /**
     * Set user
     *
     * @param \PricerBundle\Entity\User $user
     *
     * @return ReadyPriceList
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
     * Set priceList
     *
     * @param \PricerBundle\Entity\PriceList $priceList
     *
     * @return ReadyPriceList
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

    public function setParent(OriginalPriceListInterface $originalPriceList)
    {
        $this->setOriginalPriceList($originalPriceList);
        $this->setUser($originalPriceList->getUser());
        $this->setPriceList($originalPriceList->getPriceList());
    }

}
