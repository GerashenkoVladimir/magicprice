<?php

namespace PricerBundle\Entity;

/**
 * MarginRate
 */
class MarginRate
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $fromPrice;

    /**
     * @var float
     */
    private $toPrice;

    /**
     * @var int
     */
    private $marginRate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fromPrice
     *
     * @param float $fromPrice
     *
     * @return MarginRate
     */
    public function setFromPrice($fromPrice)
    {
        $this->fromPrice = $fromPrice;

        return $this;
    }

    /**
     * Get fromPrice
     *
     * @return float
     */
    public function getFromPrice()
    {
        return $this->fromPrice;
    }

    /**
     * Set toPrice
     *
     * @param float $toPrice
     *
     * @return MarginRate
     */
    public function setToPrice($toPrice)
    {
        $this->toPrice = $toPrice;

        return $this;
    }

    /**
     * Get toPrice
     *
     * @return float
     */
    public function getToPrice()
    {
        return $this->toPrice;
    }

    /**
     * Set marginRate
     *
     * @param integer $marginRate
     *
     * @return MarginRate
     */
    public function setMarginRate($marginRate)
    {
        $this->marginRate = $marginRate;

        return $this;
    }

    /**
     * Get marginRate
     *
     * @return int
     */
    public function getMarginRate()
    {
        return $this->marginRate;
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
     * @return MarginRate
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
}
