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
     * @var \Acme\AccountBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="Image")
     */
    private $imgCover;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_free_postage", type="boolean", nullable=true)
     */
    private $isFreePostage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_returnable", type="boolean", nullable=true)
     */
    protected $isReturnable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    protected $isActive = false;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text")
     */
    private $intro;

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer", nullable=true)
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_time", type="datetime", nullable=true)
     */
    private $expireTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=true)
     */
    private $createTime;

    /**
     * @var float
     *
     * @ORM\Column(name="start_price", type="float", nullable=true)
     */
    private $startPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="step_price", type="float", nullable=true)
     */
    private $stepPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="reference_price", type="float", nullable=true)
     */
    private $referencePrice;

    /**
     * @var float
     *
     * @ORM\Column(name="fixed_price", type="float", nullable=true)
     */
    private $fixedPrice;


    /**
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Payment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     **/
    protected $topPayment;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="product")
     */
    protected $images;

    /**
     * @var integer
     *
     * @ORM\Column(name="like_count", type="integer", nullable=true)
     */
    protected $likeCount;

    /**
     * @var \Acme\AccountBundle\Entity\User[]
     *
     * @ORM\ManyToMany(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="likedProducts")
     * @ORM\JoinTable(
     *  name="user_product_likes",
     *  joinColumns={
     *      @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $likeUsers;


    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="product")
     */
    protected $payments;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="linkProduct")
     */
    protected $messages;

    /**
     * @ORM\OneToMany(targetEntity="AuctionOrder", mappedBy="product")
     */
    protected $orders;

    /**
     * @ORM\OneToMany(targetEntity="ProductEvent", mappedBy="product")
     */
    protected $events;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_generated_order", type="boolean", nullable=true)
     */
    private $hasGeneratedOrder = false;


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
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createTime = new \DateTime();
    }

    /**
     * Add images
     *
     * @param \AppBundle\Entity\Image $images
     * @return Product
     */
    public function addImage(\AppBundle\Entity\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \AppBundle\Entity\Image $images
     */
    public function removeImage(\AppBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set user
     *
     * @param \Acme\AccountBundle\Entity\User $user
     * @return Product
     */
    public function setUser(\Acme\AccountBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\AccountBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set isReturnable
     *
     * @param boolean $isReturnable
     * @return Product
     */
    public function setIsReturnable($isReturnable)
    {
        $this->isReturnable = $isReturnable;

        return $this;
    }

    /**
     * Get isReturnable
     *
     * @return boolean 
     */
    public function getIsReturnable()
    {
        return $this->isReturnable;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Product
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Product
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add likeUsers
     *
     * @param \Acme\AccountBundle\Entity\User $likeUsers
     * @return Product
     */
    public function addLikeUser(\Acme\AccountBundle\Entity\User $likeUsers)
    {
        $this->likeUsers[] = $likeUsers;

        return $this;
    }

    /**
     * Remove likeUsers
     *
     * @param \Acme\AccountBundle\Entity\User $likeUsers
     */
    public function removeLikeUser(\Acme\AccountBundle\Entity\User $likeUsers)
    {
        $this->likeUsers->removeElement($likeUsers);
    }

    /**
     * Get likeUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLikeUsers()
    {
        return $this->likeUsers;
    }

    /**
     * Add payments
     *
     * @param \AppBundle\Entity\Payment $payments
     * @return Product
     */
    public function addPayment(\AppBundle\Entity\Payment $payments)
    {
        $this->payments[] = $payments;

        return $this;
    }

    /**
     * Remove payments
     *
     * @param \AppBundle\Entity\Payment $payments
     */
    public function removePayment(\AppBundle\Entity\Payment $payments)
    {
        $this->payments->removeElement($payments);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Add messages
     *
     * @param \AppBundle\Entity\Payment $messages
     * @return Product
     */
    public function addMessage(\AppBundle\Entity\Payment $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \AppBundle\Entity\Payment $messages
     */
    public function removeMessage(\AppBundle\Entity\Payment $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add orders
     *
     * @param \AppBundle\Entity\AuctionOrder $orders
     * @return Product
     */
    public function addOrder(\AppBundle\Entity\AuctionOrder $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \AppBundle\Entity\AuctionOrder $orders
     */
    public function removeOrder(\AppBundle\Entity\AuctionOrder $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add events
     *
     * @param \AppBundle\Entity\ProductEvent $events
     * @return Product
     */
    public function addEvent(\AppBundle\Entity\ProductEvent $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \AppBundle\Entity\ProductEvent $events
     */
    public function removeEvent(\AppBundle\Entity\ProductEvent $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set likeCount
     *
     * @param integer $likeCount
     * @return Product
     */
    public function setLikeCount($likeCount)
    {
        $this->likeCount = $likeCount;

        return $this;
    }

    /**
     * Get likeCount
     *
     * @return integer 
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * Set topPayment
     *
     * @param \AppBundle\Entity\Payment $topPayment
     * @return Product
     */
    public function setTopPayment(\AppBundle\Entity\Payment $topPayment = null)
    {
        $this->topPayment = $topPayment;

        return $this;
    }

    /**
     * Get topPayment
     *
     * @return \AppBundle\Entity\Payment 
     */
    public function getTopPayment()
    {
        return $this->topPayment;
    }

    /**
     * Set hasGeneratedOrder
     *
     * @param boolean $hasGeneratedOrder
     * @return Product
     */
    public function setHasGeneratedOrder($hasGeneratedOrder)
    {
        $this->hasGeneratedOrder = $hasGeneratedOrder;

        return $this;
    }

    /**
     * Get hasGeneratedOrder
     *
     * @return boolean 
     */
    public function getHasGeneratedOrder()
    {
        return $this->hasGeneratedOrder;
    }
}
