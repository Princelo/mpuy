<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table()
 * @ORM\Entity
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
}
