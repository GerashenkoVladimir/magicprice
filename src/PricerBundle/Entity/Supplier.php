<?php

namespace PricerBundle\Entity;

/**
 * Supplier
 */
class Supplier
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $priceCurrency;

    /**
     * @var float
     */
    private $exchangeRate;

    /**
     * @var integer
     */
    private $marginRate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $priceList;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->priceList = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Supplier
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
     * Set code
     *
     * @param string $code
     *
     * @return Supplier
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set priceCurrency
     *
     * @param string $priceCurrency
     *
     * @return Supplier
     */
    public function setPriceCurrency($priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    /**
     * Get priceCurrency
     *
     * @return string
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }

    /**
     * Set exchangeRate
     *
     * @param float $exchangeRate
     *
     * @return Supplier
     */
    public function setExchangeRate($exchangeRate)
    {
        $rate = (float)preg_replace('|[,]|', '.', $exchangeRate);
        $this->exchangeRate = $rate > 0 ? $rate : $exchangeRate;

        return $this;
    }

    /**
     * Get exchangeRate
     *
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * Set marginRate
     *
     * @param integer $marginRate
     *
     * @return Supplier
     */
    public function setMarginRate($marginRate)
    {
        $this->marginRate = $marginRate;

        return $this;
    }

    /**
     * Get marginRate
     *
     * @return integer
     */
    public function getMarginRate()
    {
        return $this->marginRate;
    }

    /**
     * Add priceList
     *
     * @param \PricerBundle\Entity\PriceList $priceList
     *
     * @return Supplier
     */
    public function addPriceList(\PricerBundle\Entity\PriceList $priceList)
    {
        $this->priceList[] = $priceList;

        return $this;
    }

    /**
     * Remove priceList
     *
     * @param \PricerBundle\Entity\PriceList $priceList
     */
    public function removePriceList(\PricerBundle\Entity\PriceList $priceList)
    {
        $this->priceList->removeElement($priceList);
    }

    /**
     * Get priceList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPriceList()
    {
        return $this->priceList;
    }
    /**
     * @var \PricerBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \PricerBundle\Entity\User $user
     *
     * @return Supplier
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandRuler;


    /**
     * Add brandRuler
     *
     * @param \PricerBundle\Entity\BrandRuler $brandRuler
     *
     * @return Supplier
     */
    public function addBrandRuler(\PricerBundle\Entity\BrandRuler $brandRuler)
    {
        $this->brandRuler[] = $brandRuler;

        return $this;
    }

    /**
     * Remove brandRuler
     *
     * @param \PricerBundle\Entity\BrandRuler $brandRuler
     */
    public function removeBrandRuler(\PricerBundle\Entity\BrandRuler $brandRuler)
    {
        $this->brandRuler->removeElement($brandRuler);
    }

    /**
     * Get brandRuler
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrandRuler()
    {
        return $this->brandRuler;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vendorCodeRuler;


    /**
     * Add vendorCodeRuler
     *
     * @param \PricerBundle\Entity\VendorCodeRuler $vendorCodeRuler
     *
     * @return Supplier
     */
    public function addVendorCodeRuler(\PricerBundle\Entity\VendorCodeRuler $vendorCodeRuler)
    {
        $this->vendorCodeRuler[] = $vendorCodeRuler;

        return $this;
    }

    /**
     * Remove vendorCodeRuler
     *
     * @param \PricerBundle\Entity\VendorCodeRuler $vendorCodeRuler
     */
    public function removeVendorCodeRuler(\PricerBundle\Entity\VendorCodeRuler $vendorCodeRuler)
    {
        $this->vendorCodeRuler->removeElement($vendorCodeRuler);
    }

    /**
     * Get vendorCodeRuler
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVendorCodeRuler()
    {
        return $this->vendorCodeRuler;
    }
}