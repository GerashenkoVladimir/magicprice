<?php

namespace PricerBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var bool
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
    }

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password
        ));
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        
    }
    /**
     * @var string
     */
    private $tariffPlane;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $secondName;

    /**
     * @var \DateTime
     */
    private $birthDate;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $facebook;

    /**
     * @var string
     */
    private $skype;

    /**
     * @var string
     */
    private $viber;

    /**
     * @var string
     */
    private $anotherMessenger;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $house;

    /**
     * @var string
     */
    private $flat;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $supplier;


    /**
     * Set tariffPlane
     *
     * @param string $tariffPlane
     *
     * @return User
     */
    public function setTariffPlane($tariffPlane)
    {
        $this->tariffPlane = $tariffPlane;

        return $this;
    }

    /**
     * Get tariffPlane
     *
     * @return string
     */
    public function getTariffPlane()
    {
        return $this->tariffPlane;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     *
     * @return User
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return User
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set skype
     *
     * @param string $skype
     *
     * @return User
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set viber
     *
     * @param string $viber
     *
     * @return User
     */
    public function setViber($viber)
    {
        $this->viber = $viber;

        return $this;
    }

    /**
     * Get viber
     *
     * @return string
     */
    public function getViber()
    {
        return $this->viber;
    }

    /**
     * Set anotherMessenger
     *
     * @param string $anotherMessenger
     *
     * @return User
     */
    public function setAnotherMessenger($anotherMessenger)
    {
        $this->anotherMessenger = $anotherMessenger;

        return $this;
    }

    /**
     * Get anotherMessenger
     *
     * @return string
     */
    public function getAnotherMessenger()
    {
        return $this->anotherMessenger;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return User
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set house
     *
     * @param string $house
     *
     * @return User
     */
    public function setHouse($house)
    {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return string
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set flat
     *
     * @param string $flat
     *
     * @return User
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;

        return $this;
    }

    /**
     * Get flat
     *
     * @return string
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Add supplier
     *
     * @param \PricerBundle\Entity\Supplier $supplier
     *
     * @return User
     */
    public function addSupplier(\PricerBundle\Entity\Supplier $supplier)
    {
        $this->supplier[] = $supplier;

        return $this;
    }

    /**
     * Remove supplier
     *
     * @param \PricerBundle\Entity\Supplier $supplier
     */
    public function removeSupplier(\PricerBundle\Entity\Supplier $supplier)
    {
        $this->supplier->removeElement($supplier);
    }

    /**
     * Get supplier
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSupplier()
    {
        return $this->supplier;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $priceList;


    /**
     * Add priceList
     *
     * @param \PricerBundle\Entity\PriceList $priceList
     *
     * @return User
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $originalPriceList;


    /**
     * Add originalPriceList
     *
     * @param \PricerBundle\Entity\OriginalPriceList $originalPriceList
     *
     * @return User
     */
    public function addOriginalPriceList(\PricerBundle\Entity\OriginalPriceList $originalPriceList)
    {
        $this->originalPriceList[] = $originalPriceList;

        return $this;
    }

    /**
     * Remove originalPriceList
     *
     * @param \PricerBundle\Entity\OriginalPriceList $originalPriceList
     */
    public function removeOriginalPriceList(\PricerBundle\Entity\OriginalPriceList $originalPriceList)
    {
        $this->originalPriceList->removeElement($originalPriceList);
    }

    /**
     * Get originalPriceList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOriginalPriceList()
    {
        return $this->originalPriceList;
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
     * @return User
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $marginRate;


    /**
     * Add marginRate
     *
     * @param \PricerBundle\Entity\MarginRate $marginRate
     *
     * @return User
     */
    public function addMarginRate(\PricerBundle\Entity\MarginRate $marginRate)
    {
        $this->marginRate[] = $marginRate;

        return $this;
    }

    /**
     * Remove marginRate
     *
     * @param \PricerBundle\Entity\MarginRate $marginRate
     */
    public function removeMarginRate(\PricerBundle\Entity\MarginRate $marginRate)
    {
        $this->marginRate->removeElement($marginRate);
    }

    /**
     * Get marginRate
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarginRate()
    {
        return $this->marginRate;
    }
}
