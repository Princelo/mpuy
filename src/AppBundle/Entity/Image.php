<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Image
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="images")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @var string
     *
     * @ORM\Column(name="localId", type="string", length=255)
     */
    private $localId;

    /**
     * @var string
     *
     * @ORM\Column(name="serverId", type="string", length=255)
     */
    private $serverId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime")
     */
    private $createTime;

    /**
     * @var string
     *
     * @ORM\Column(name="origin", type="string", length=255)
     */
    private $origin;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb", type="string", length=255)
     */
    private $thumb;


    public function __construct()
    {
        $this->createTime = new \DateTime();
    }

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
     * Set localId
     *
     * @param string $localId
     * @return Image
     */
    public function setLocalId($localId)
    {
        $this->localId = $localId;

        return $this;
    }

    /**
     * Get localId
     *
     * @return string 
     */
    public function getLocalId()
    {
        return $this->localId;
    }

    /**
     * Set serverId
     *
     * @param string $serverId
     * @return Image
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;

        return $this;
    }

    /**
     * Get serverId
     *
     * @return string 
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Image
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
     * Set origin
     *
     * @param string $origin
     * @return Image
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set thumb
     *
     * @param string $thumb
     * @return Image
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return string 
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return Image
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
}
