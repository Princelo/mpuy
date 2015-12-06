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
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Payment")
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     **/
    protected $payment;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="linkOrder")
     */
    protected $messages;

    /**
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="closeOrders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $closedBy;

    /**
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="finishOrders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $finishedBy;


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
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createTime = new \DateTime();
        $this->updateTime = new \DateTime();
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

    /**
     * Set payment
     *
     * @param \AppBundle\Entity\Payment $payment
     * @return AuctionOrder
     */
    public function setPayment(\AppBundle\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return \AppBundle\Entity\Payment 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Add messages
     *
     * @param \AppBundle\Entity\Message $messages
     * @return AuctionOrder
     */
    public function addMessage(\AppBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \AppBundle\Entity\Message $messages
     */
    public function removeMessage(\AppBundle\Entity\Message $messages)
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
     * Set closedBy
     *
     * @param \Acme\AccountBundle\Entity\User $closedBy
     * @return AuctionOrder
     */
    public function setClosedBy(\Acme\AccountBundle\Entity\User $closedBy = null)
    {
        $this->closedBy = $closedBy;

        return $this;
    }

    /**
     * Get closedBy
     *
     * @return \Acme\AccountBundle\Entity\User 
     */
    public function getClosedBy()
    {
        return $this->closedBy;
    }

    /**
     * Set finishedBy
     *
     * @param \Acme\AccountBundle\Entity\User $finishedBy
     * @return AuctionOrder
     */
    public function setFinishedBy(\Acme\AccountBundle\Entity\User $finishedBy = null)
    {
        $this->finishedBy = $finishedBy;

        return $this;
    }

    /**
     * Get finishedBy
     *
     * @return \Acme\AccountBundle\Entity\User 
     */
    public function getFinishedBy()
    {
        return $this->finishedBy;
    }
}
