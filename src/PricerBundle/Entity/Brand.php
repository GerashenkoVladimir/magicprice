<?php

namespace PricerBundle\Entity;

/**
 * Brand
 */
class Brand
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandRuler;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vendorCodeRuler;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->brandRuler = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vendorCodeRuler = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Brand
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
     * Add brandRuler
     *
     * @param \PricerBundle\Entity\BrandRuler $brandRuler
     *
     * @return Brand
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
     * Add vendorCodeRuler
     *
     * @param \PricerBundle\Entity\VendorCodeRuler $vendorCodeRuler
     *
     * @return Brand
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
