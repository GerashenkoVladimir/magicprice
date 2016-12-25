<?php

namespace PricerBundle\Entity;

/**
 * VendorCodeRuler
 */
class VendorCodeRuler
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ruler;

    /**
     * @var string
     */
    private $replacement;

    /**
     * @var \PricerBundle\Entity\Brand
     */
    private $brand;


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
     * Set ruler
     *
     * @param string $ruler
     *
     * @return VendorCodeRuler
     */
    public function setRuler($ruler)
    {
        $this->ruler = $ruler;

        return $this;
    }

    /**
     * Get ruler
     *
     * @return string
     */
    public function getRuler()
    {
        return $this->ruler;
    }

    /**
     * Set replacement
     *
     * @param string $replacement
     *
     * @return VendorCodeRuler
     */
    public function setReplacement($replacement)
    {
        $this->replacement = $replacement;

        return $this;
    }

    /**
     * Get replacement
     *
     * @return string
     */
    public function getReplacement()
    {
        return $this->replacement;
    }

    /**
     * Set brand
     *
     * @param \PricerBundle\Entity\Brand $brand
     *
     * @return VendorCodeRuler
     */
    public function setBrand(\PricerBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \PricerBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
    /**
     * @var \PricerBundle\Entity\Supplier
     */
    private $supplier;


    /**
     * Set supplier
     *
     * @param \PricerBundle\Entity\Supplier $supplier
     *
     * @return VendorCodeRuler
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
}
