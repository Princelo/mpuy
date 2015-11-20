<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PaymentRepository")
 * @ORM\EntityListeners({ "AppBundle\Entity\Listener\PaymentListener" })
 */
class Payment
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
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="payments")
     * @ORM\JoinColumn(name="pay_user_id", referencedColumnName="id")
     */
    protected $payUser;

    /**
     * @var \Acme\AccountBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="receivePayments")
     * @ORM\JoinColumn(name="receive_user_id", referencedColumnName="id")
     */
    protected $receiveUser;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pay_time", type="datetime")
     */
    private $payTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_paid", type="boolean")
     */
    private $hasPaid = false;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="payments")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_generated_order", type="boolean")
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
     * Set payUser
     *
     * @param integer $payUser
     * @return Payment
     */
    public function setPayUser($payUser)
    {
        $this->payUser = $payUser;

        return $this;
    }

    /**
     * Get payUser
     *
     * @return integer 
     */
    public function getPayUser()
    {
        return $this->payUser;
    }

    /**
     * Set recieveUser
     *
     * @param integer $recieveUser
     * @return Payment
     */
    public function setRecieveUser($recieveUser)
    {
        $this->recieveUser = $recieveUser;

        return $this;
    }

    /**
     * Get recieveUser
     *
     * @return integer 
     */
    public function getRecieveUser()
    {
        return $this->recieveUser;
    }

    /**
     * Set volume
     *
     * @param float $volume
     * @return Payment
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float 
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set payTime
     *
     * @param \DateTime $payTime
     * @return Payment
     */
    public function setPayTime($payTime)
    {
        $this->payTime = $payTime;

        return $this;
    }

    /**
     * Get payTime
     *
     * @return \DateTime 
     */
    public function getPayTime()
    {
        return $this->payTime;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Payment
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
     * Set hasPaid
     *
     * @param boolean $hasPaid
     * @return Payment
     */
    public function setHasPaid($hasPaid)
    {
        $this->hasPaid = $hasPaid;

        return $this;
    }

    /**
     * Get hasPaid
     *
     * @return boolean 
     */
    public function getHasPaid()
    {
        return $this->hasPaid;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return Payment
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
     * Set receiveUser
     *
     * @param \Acme\AccountBundle\Entity\User $receiveUser
     * @return Payment
     */
    public function setReceiveUser(\Acme\AccountBundle\Entity\User $receiveUser = null)
    {
        $this->receiveUser = $receiveUser;

        return $this;
    }

    /**
     * Get receiveUser
     *
     * @return \Acme\AccountBundle\Entity\User 
     */
    public function getReceiveUser()
    {
        return $this->receiveUser;
    }

    /**
     * Set hasGeneratedOrder
     *
     * @param boolean $hasGeneratedOrder
     * @return Payment
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
