<?php

namespace PricerBundle\Entity;

/**
 * PriceList
 */
class PriceList
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $originalPrice;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $priceSetting;

    /**
     * @var \PricerBundle\Entity\Supplier
     */
    private $supplier;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->originalPrice = new \Doctrine\Common\Collections\ArrayCollection();
        $this->priceSetting = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return PriceList
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
     * @return PriceList
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
     * Add originalPrice
     *
     * @param \PricerBundle\Entity\OriginalPriceList $originalPrice
     *
     * @return PriceList
     */
    public function addOriginalPrice(\PricerBundle\Entity\OriginalPriceList $originalPrice)
    {
        $this->originalPrice[] = $originalPrice;

        return $this;
    }

    /**
     * Remove originalPrice
     *
     * @param \PricerBundle\Entity\OriginalPriceList $originalPrice
     */
    public function removeOriginalPrice(\PricerBundle\Entity\OriginalPriceList $originalPrice)
    {
        $this->originalPrice->removeElement($originalPrice);
    }

    /**
     * Get originalPrice
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    /**
     * Add priceSetting
     *
     * @param \PricerBundle\Entity\PriceSetting $priceSetting
     *
     * @return PriceList
     */
    public function addPriceSetting(\PricerBundle\Entity\PriceSetting $priceSetting)
    {
        $this->priceSetting[] = $priceSetting;

        return $this;
    }

    /**
     * Remove priceSetting
     *
     * @param \PricerBundle\Entity\PriceSetting $priceSetting
     */
    public function removePriceSetting(\PricerBundle\Entity\PriceSetting $priceSetting)
    {
        $this->priceSetting->removeElement($priceSetting);
    }

    /**
     * Get priceSetting
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPriceSetting()
    {
        return $this->priceSetting;
    }

    /**
     * Set supplier
     *
     * @param \PricerBundle\Entity\Supplier $supplier
     *
     * @return PriceList
     */
    public function setSupplier(\PricerBundle\Entity\Supplier $supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \PricerBundle\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
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
     * @return PriceList
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
     * @var string
     */
    private $filePath;


    /**
     * Set filePath
     *
     * @param string $filePath
     *
     * @return PriceList
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Get filePath
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $readyPriceList;


    /**
     * Add readyPriceList
     *
     * @param \PricerBundle\Entity\ReadyPriceList $readyPriceList
     *
     * @return PriceList
     */
    public function addReadyPriceList(\PricerBundle\Entity\ReadyPriceList $readyPriceList)
    {
        $this->readyPriceList[] = $readyPriceList;

        return $this;
    }

    /**
     * Remove readyPriceList
     *
     * @param \PricerBundle\Entity\ReadyPriceList $readyPriceList
     */
    public function removeReadyPriceList(\PricerBundle\Entity\ReadyPriceList $readyPriceList)
    {
        $this->readyPriceList->removeElement($readyPriceList);
    }

    /**
     * Get readyPriceList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReadyPriceList()
    {
        return $this->readyPriceList;
    }
}
