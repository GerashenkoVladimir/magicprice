<?php

namespace PricerBundle\Entity;

/**
 * PriceSetting
 */
class PriceSetting
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $settingKey;

    /**
     * @var string
     */
    private $settingValue;

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
     * Set settingKey
     *
     * @param string $settingKey
     *
     * @return PriceSetting
     */
    public function setSettingKey($settingKey)
    {
        $this->settingKey = $settingKey;

        return $this;
    }

    /**
     * Get settingKey
     *
     * @return string
     */
    public function getSettingKey()
    {
        return $this->settingKey;
    }

    /**
     * Set settingValue
     *
     * @param string $settingValue
     *
     * @return PriceSetting
     */
    public function setSettingValue($settingValue)
    {
        $this->settingValue = $settingValue;

        return $this;
    }

    /**
     * Get settingValue
     *
     * @return string
     */
    public function getSettingValue()
    {
        return $this->settingValue;
    }

    /**
     * Set priceList
     *
     * @param \PricerBundle\Entity\PriceList $priceList
     *
     * @return PriceSetting
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
}
