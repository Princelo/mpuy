<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="img_cover", type="string", length=255)
     */
    private $imgCover;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_free_postage", type="boolean")
     */
    private $isFreePostage;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text")
     */
    private $intro;

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer")
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_time", type="datetime")
     */
    private $expireTime;

    /**
     * @var float
     *
     * @ORM\Column(name="start_price", type="float")
     */
    private $startPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="step_price", type="float")
     */
    private $stepPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="reference_price", type="float")
     */
    private $referencePrice;

    /**
     * @var float
     *
     * @ORM\Column(name="fixed_price", type="float")
     */
    private $fixedPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="bid_price", type="float")
     */
    private $bidPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="top_price", type="float")
     */
    private $topPrice;


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
     * @return Product
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
     * Set imgCover
     *
     * @param string $imgCover
     * @return Product
     */
    public function setImgCover($imgCover)
    {
        $this->imgCover = $imgCover;

        return $this;
    }

    /**
     * Get imgCover
     *
     * @return string 
     */
    public function getImgCover()
    {
        return $this->imgCover;
    }

    /**
     * Set isFreePostage
     *
     * @param boolean $isFreePostage
     * @return Product
     */
    public function setIsFreePostage($isFreePostage)
    {
        $this->isFreePostage = $isFreePostage;

        return $this;
    }

    /**
     * Get isFreePostage
     *
     * @return boolean 
     */
    public function getIsFreePostage()
    {
        return $this->isFreePostage;
    }

    /**
     * Set intro
     *
     * @param string $intro
     * @return Product
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string 
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set category
     *
     * @param integer $category
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set expireTime
     *
     * @param \DateTime $expireTime
     * @return Product
     */
    public function setExpireTime($expireTime)
    {
        $this->expireTime = $expireTime;

        return $this;
    }

    /**
     * Get expireTime
     *
     * @return \DateTime 
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * Set startPrice
     *
     * @param float $startPrice
     * @return Product
     */
    public function setStartPrice($startPrice)
    {
        $this->startPrice = $startPrice;

        return $this;
    }

    /**
     * Get startPrice
     *
     * @return float 
     */
    public function getStartPrice()
    {
        return $this->startPrice;
    }

    /**
     * Set stepPrice
     *
     * @param float $stepPrice
     * @return Product
     */
    public function setStepPrice($stepPrice)
    {
        $this->stepPrice = $stepPrice;

        return $this;
    }

    /**
     * Get stepPrice
     *
     * @return float 
     */
    public function getStepPrice()
    {
        return $this->stepPrice;
    }

    /**
     * Set referencePrice
     *
     * @param float $referencePrice
     * @return Product
     */
    public function setReferencePrice($referencePrice)
    {
        $this->referencePrice = $referencePrice;

        return $this;
    }

    /**
     * Get referencePrice
     *
     * @return float 
     */
    public function getReferencePrice()
    {
        return $this->referencePrice;
    }

    /**
     * Set fixedPrice
     *
     * @param float $fixedPrice
     * @return Product
     */
    public function setFixedPrice($fixedPrice)
    {
        $this->fixedPrice = $fixedPrice;

        return $this;
    }

    /**
     * Get fixedPrice
     *
     * @return float 
     */
    public function getFixedPrice()
    {
        return $this->fixedPrice;
    }

    /**
     * Set bidPrice
     *
     * @param float $bidPrice
     * @return Product
     */
    public function setBidPrice($bidPrice)
    {
        $this->bidPrice = $bidPrice;

        return $this;
    }

    /**
     * Get bidPrice
     *
     * @return float 
     */
    public function getBidPrice()
    {
        return $this->bidPrice;
    }

    /**
     * Set topPrice
     *
     * @param float $topPrice
     * @return Product
     */
    public function setTopPrice($topPrice)
    {
        $this->topPrice = $topPrice;

        return $this;
    }

    /**
     * Get topPrice
     *
     * @return float 
     */
    public function getTopPrice()
    {
        return $this->topPrice;
    }
}
