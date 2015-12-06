<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MessageRepository")
 */
class Message
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
     * @ORM\Column(name="context", type="text")
     */
    private $context;

    /**
     * @var \Acme\AccountBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="\Acme\AccountBundle\Entity\User", inversedBy="messages")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $receiveUser;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_link_product", type="boolean")
     */
    private $isLinkProduct;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_link_order", type="boolean", nullable=true)
     */
    private $isLinkOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_read", type="boolean")
     */
    private $isRead;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=true)
     */
    private $createTime;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="messages")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $linkProduct;

    /**
     * @var AuctionOrder
     * @ORM\ManyToOne(targetEntity="AuctionOrder", inversedBy="messages")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $linkOrder;

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
     * Set context
     *
     * @param string $context
     * @return Message
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string 
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set isLinkProduct
     *
     * @param boolean $isLinkProduct
     * @return Message
     */
    public function setIsLinkProduct($isLinkProduct)
    {
        $this->isLinkProduct = $isLinkProduct;

        return $this;
    }

    /**
     * Get isLinkProduct
     *
     * @return boolean 
     */
    public function getIsLinkProduct()
    {
        return $this->isLinkProduct;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     * @return Message
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return boolean 
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Message
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
     * Set receiveUser
     *
     * @param \Acme\AccountBundle\Entity\User $receiveUser
     * @return Message
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
     * Set linkProduct
     *
     * @param \AppBundle\Entity\Product $linkProduct
     * @return Message
     */
    public function setLinkProduct(\AppBundle\Entity\Product $linkProduct = null)
    {
        $this->linkProduct = $linkProduct;

        return $this;
    }

    /**
     * Get linkProduct
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getLinkProduct()
    {
        return $this->linkProduct;
    }

    /**
     * Set isLinkOrder
     *
     * @param boolean $isLinkOrder
     * @return Message
     */
    public function setIsLinkOrder($isLinkOrder)
    {
        $this->isLinkOrder = $isLinkOrder;

        return $this;
    }

    /**
     * Get isLinkOrder
     *
     * @return boolean 
     */
    public function getIsLinkOrder()
    {
        return $this->isLinkOrder;
    }

    /**
     * Set linkOrder
     *
     * @param \AppBundle\Entity\AuctionOrder $linkOrder
     * @return Message
     */
    public function setLinkOrder(\AppBundle\Entity\AuctionOrder $linkOrder = null)
    {
        $this->linkOrder = $linkOrder;

        return $this;
    }

    /**
     * Get linkOrder
     *
     * @return \AppBundle\Entity\AuctionOrder 
     */
    public function getLinkOrder()
    {
        return $this->linkOrder;
    }
}
