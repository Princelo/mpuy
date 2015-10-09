<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AddressRepository")
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=20)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=20)
     */
    private $mobile;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     */
    private $cityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="province_id", type="integer")
     */
    private $provinceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="district_id", type="integer")
     */
    private $districtId;

    /**
     * @var string
     *
     * @ORM\Column(name="address_info", type="string", length=255)
     */
    private $addressInfo;


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
     * Set contact
     *
     * @param string $contact
     * @return Address
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Address
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     * @return Address
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer 
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set proviceId
     *
     * @param integer $proviceId
     * @return Address
     */
    public function setProviceId($proviceId)
    {
        $this->proviceId = $proviceId;

        return $this;
    }

    /**
     * Get proviceId
     *
     * @return integer 
     */
    public function getProviceId()
    {
        return $this->proviceId;
    }

    /**
     * Set provinceId
     *
     * @param integer $provinceId
     * @return Address
     */
    public function setProvinceId($provinceId)
    {
        $this->provinceId = $provinceId;

        return $this;
    }

    /**
     * Get provinceId
     *
     * @return integer 
     */
    public function getProvinceId()
    {
        return $this->provinceId;
    }

    /**
     * Set districtId
     *
     * @param integer $districtId
     * @return Address
     */
    public function setDistrictId($districtId)
    {
        $this->districtId = $districtId;

        return $this;
    }

    /**
     * Get districtId
     *
     * @return integer 
     */
    public function getDistrictId()
    {
        return $this->districtId;
    }

    /**
     * Set addressInfo
     *
     * @param string $addressInfo
     * @return Address
     */
    public function setAddressInfo($addressInfo)
    {
        $this->addressInfo = $addressInfo;

        return $this;
    }

    /**
     * Get addressInfo
     *
     * @return string 
     */
    public function getAddressInfo()
    {
        return $this->addressInfo;
    }
}
