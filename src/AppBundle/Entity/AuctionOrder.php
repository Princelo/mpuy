<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuctionOrder
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AuctionOrderRepository")
 */
class AuctionOrder
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
     * @ORM\Column(name="order_sn", type="string", length=32)
     */
    private $orderSn;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="broughtOrders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $buyer;

    /**
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="soldOrders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $seller;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime")
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime")
     */
    private $updateTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="orders")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="delivery_status", type="integer")
     */
    private $deliveryStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="pay_status", type="integer")
     */
    private $payStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_delete", type="boolean")
     */
    private $isDelete;

    /**
     * @var integer
     *
     * @ORM\Column(name="return_total_score", type="integer")
     */
    private $returnTotalScore;

    /**
     * @var float
     *
     * @ORM\Column(name="bid_price", type="float")
     */
    private $bidPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="payment_id", type="integer")
     */
    private $paymentId;

    /**
     * @var float
     *
     * @ORM\Column(name="refund_money", type="float")
     */
    private $refundMoney;

    /**
     * @var integer
     *
     * @ORM\Column(name="refund_status", type="integer")
     */
    private $refundStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_argument", type="boolean")
     */
    private $hasArgument;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_break_rule", type="boolean")
     */
    private $hasBreakRule;

    /**
     * @var string
     *
     * @ORM\Column(name="fail_description", type="string", nullable=true)
     */
    private $failDescription;

    /**
     * @ORM\OneToMany(targetEntity="ProductEvent", mappedBy="order")
     */
    protected $events;


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
     * Set orderSn
     *
     * @param string $orderSn
     * @return AuctionOrder
     */
    public function setOrderSn($orderSn)
    {
        $this->orderSn = $orderSn;

        return $this;
    }

    /**
     * Get orderSn
     *
     * @return string 
     */
    public function getOrderSn()
    {
        return $this->orderSn;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return AuctionOrder
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set buyer
     *
     * @param integer $buyer
     * @return AuctionOrder
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer
     *
     * @return integer 
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set seller
     *
     * @param integer $seller
     * @return AuctionOrder
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return integer 
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return AuctionOrder
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
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return AuctionOrder
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return AuctionOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     * @return AuctionOrder
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set deliveryStatus
     *
     * @param integer $deliveryStatus
     * @return AuctionOrder
     */
    public function setDeliveryStatus($deliveryStatus)
    {
        $this->deliveryStatus = $deliveryStatus;

        return $this;
    }

    /**
     * Get deliveryStatus
     *
     * @return integer 
     */
    public function getDeliveryStatus()
    {
        return $this->deliveryStatus;
    }

    /**
     * Set payStatus
     *
     * @param integer $payStatus
     * @return AuctionOrder
     */
    public function setPayStatus($payStatus)
    {
        $this->payStatus = $payStatus;

        return $this;
    }

    /**
     * Get payStatus
     *
     * @return integer 
     */
    public function getPayStatus()
    {
        return $this->payStatus;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return AuctionOrder
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean 
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set returnTotalScore
     *
     * @param integer $returnTotalScore
     * @return AuctionOrder
     */
    public function setReturnTotalScore($returnTotalScore)
    {
        $this->returnTotalScore = $returnTotalScore;

        return $this;
    }

    /**
     * Get returnTotalScore
     *
     * @return integer 
     */
    public function getReturnTotalScore()
    {
        return $this->returnTotalScore;
    }

    /**
     * Set bidPrice
     *
     * @param float $bidPrice
     * @return AuctionOrder
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
     * Set paymentId
     *
     * @param integer $paymentId
     * @return AuctionOrder
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    /**
     * Get paymentId
     *
     * @return integer 
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * Set refundMoney
     *
     * @param float $refundMoney
     * @return AuctionOrder
     */
    public function setRefundMoney($refundMoney)
    {
        $this->refundMoney = $refundMoney;

        return $this;
    }

    /**
     * Get refundMoney
     *
     * @return float 
     */
    public function getRefundMoney()
    {
        return $this->refundMoney;
    }

    /**
     * Set refundStatus
     *
     * @param integer $refundStatus
     * @return AuctionOrder
     */
    public function setRefundStatus($refundStatus)
    {
        $this->refundStatus = $refundStatus;

        return $this;
    }

    /**
     * Get refundStatus
     *
     * @return integer 
     */
    public function getRefundStatus()
    {
        return $this->refundStatus;
    }

    /**
     * Set hasArgument
     *
     * @param boolean $hasArgument
     * @return AuctionOrder
     */
    public function setHasArgument($hasArgument)
    {
        $this->hasArgument = $hasArgument;

        return $this;
    }

    /**
     * Get hasArgument
     *
     * @return boolean 
     */
    public function getHasArgument()
    {
        return $this->hasArgument;
    }

    /**
     * Set hasBreakRule
     *
     * @param boolean $hasBreakRule
     * @return AuctionOrder
     */
    public function setHasBreakRule($hasBreakRule)
    {
        $this->hasBreakRule = $hasBreakRule;

        return $this;
    }

    /**
     * Get hasBreakRule
     *
     * @return boolean 
     */
    public function getHasBreakRule()
    {
        return $this->hasBreakRule;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set failDescription
     *
     * @param string $failDescription
     * @return AuctionOrder
     */
    public function setFailDescription($failDescription)
    {
        $this->failDescription = $failDescription;

        return $this;
    }

    /**
     * Get failDescription
     *
     * @return string 
     */
    public function getFailDescription()
    {
        return $this->failDescription;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return AuctionOrder
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Add events
     *
     * @param \AppBundle\Entity\ProductEvent $events
     * @return AuctionOrder
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
}
