<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductEvent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProductEventRepository")
 */
class ProductEvent
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
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="events")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="AuctionOrder", inversedBy="events")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createTime", type="datetime")
     */
    private $createTime;

    /**
     * @ORM\ManyToOne(targetEntity="Acme\AccountBundle\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $actionUser;


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
     * Set type
     *
     * @param integer $type
     * @return ProductEvent
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
     * Set product
     *
     * @param integer $product
     * @return ProductEvent
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return integer 
     */
    public function getProduct()
    {
        return $this->product;
    }


    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return ProductEvent
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
     * Set actionUser
     *
     * @param integer $actionUser
     * @return ProductEvent
     */
    public function setActionUser($actionUser)
    {
        $this->actionUser = $actionUser;

        return $this;
    }

    /**
     * Get actionUser
     *
     * @return integer 
     */
    public function getActionUser()
    {
        return $this->actionUser;
    }

    /**
     * Set order
     *
     * @param \AppBundle\Entity\AuctionOrder $order
     * @return ProductEvent
     */
    public function setOrder(\AppBundle\Entity\AuctionOrder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \AppBundle\Entity\AuctionOrder 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
