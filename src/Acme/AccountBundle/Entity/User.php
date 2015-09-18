<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 9/14/15
 * Time: 16:27
 */
namespace Acme\AccountBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="Acme\AccountBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $isActive;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=true)
     */
    protected $nickname;

    /**
     * @ORM\Column(type="float", options={"default" = 0})
     */
    protected $deposit = 0;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $points = 0;

    /**
     * @ORM\Column(name="is_verified", type="boolean", options={"default" = false})
     */
    protected $isVerified = false;

    /**
     * @ORM\Column(name="verify_money", type="float", options={"default" = 0})
     */
    protected $verifyMoney = 0;

    /**
     * @ORM\Column(name="follow_count", type="integer", options={"default" = 0})
     */
    protected $followCount = 0;

    /**
     * @ORM\Column(name="fans_count", type="integer", options={"default" = 0})
     */
    protected $fansCount = 0;

    /**
     * @ORM\Column(name="bought_count", type="integer", options={"default" = 0})
     */
    protected $boughtCount = 0;

    /**
     * @ORM\Column(name="sold_count", type="integer", options={"default" = 0})
     */
    protected $soldCount = 0;

    /**
     * @ORM\Column(name="liked_count", type="integer", options={"default" = 0})
     */
    protected $likedCount = 0;

    /**
     * @ORM\Column(name="order_count", type="integer", options={"default" = 0})
     */
    protected $orderCount = 0;

    /**
     * @ORM\Column(name="message_count", type="integer", options={"default" = 0})
     */
    protected $messageCount = 0;

    /**
     * @ORM\Column(name="message_unread_count", type="integer", options={"default" = 0})
     */
    protected $messageUnreadCount = 0;

    /**
     * @ORM\Column(name="argue_count", type="integer", options={"default" = 0})
     */
    protected $argueCount = 0;

    /**
     * @ORM\Column(name="break_rule_count", type="integer", options={"default" = 0})
     */
    protected $breakRuleCount = 0;

    /**
     * @ORM\Column(name="store_score", type="integer", options={"default" = 0})
     */
    protected $storeScore = 0;

    /**
     * @ORM\Column(name="argue_ratio", type="integer", options={"default" = 0})
     */
    protected $argueRatio = 0;

    /**
     * @ORM\Column(name="break_rule_ratio", type="integer", options={"default" = 0})
     */
    protected $breakRuleRatio = 0;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $intro;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $contact;

    /**
     * @ORM\Column(name="wechat_id", type="string", length=50, nullable=true)
     */
    protected $wechatId;

    /**
     * @ORM\Column(name="wechat_openid", type="string", length=50, nullable=true)
     */
    protected $wechatOpenId;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $mobile;

    /**
     * @ORM\Column(name="city_id", type="integer", options={"default" = 0})
     */
    protected $cityId = 0;

    /**
     * @ORM\Column(name="province_id", type="integer", options={"default" = 0})
     */
    protected $provinceId = 0;

    /**
     * @ORM\Column(name="district_id", type="integer", options={"default" = 0})
     */
    protected $districtId = 0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(name="create_time", type="datetime", length=255)
     */
    protected $createTime;

    /**
     * @ORM\Column(name="update_time", type="datetime", length=255)
     */
    protected $updateTime;

    /**
     * @ORM\Column(name="login_time", type="datetime", length=255)
     */
    protected $loginTime;

    public function __construct()
    {
        $this->isActive = true;
        $now = new \DateTime();
        $this->createTime = $now;
        $this->updateTime = $now;
        $this->loginTime = $now;
        // may not be needed, see section on salt below
        $this->salt = md5(uniqid(null, true));
    }

    /*public function eraseCredentials()
    {
    }

/*    /** @see \Serializable::serialize()
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

     @see \Serializable::unserialize()
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    } */

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /*
     * Set password
     *
     * @param string $password
     * @return User
    public function setPassword($password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $password;

        return $this;
    }
     */

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
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
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set deposit
     *
     * @param float $deposit
     * @return User
     */
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;

        return $this;
    }

    /**
     * Get deposit
     *
     * @return float
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return User
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set isVerified
     *
     * @param boolean $isVerified
     * @return User
     */
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * Get isVerified
     *
     * @return boolean
     */
    public function getIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * Set verifyMoney
     *
     * @param float $verifyMoney
     * @return User
     */
    public function setVerifyMoney($verifyMoney)
    {
        $this->verifyMoney = $verifyMoney;

        return $this;
    }

    /**
     * Get verifyMoney
     *
     * @return float
     */
    public function getVerifyMoney()
    {
        return $this->verifyMoney;
    }

    /**
     * Set followCount
     *
     * @param integer $followCount
     * @return User
     */
    public function setFollowCount($followCount)
    {
        $this->followCount = $followCount;

        return $this;
    }

    /**
     * Get followCount
     *
     * @return integer
     */
    public function getFollowCount()
    {
        return $this->followCount;
    }

    /**
     * Set fansCount
     *
     * @param integer $fansCount
     * @return User
     */
    public function setFansCount($fansCount)
    {
        $this->fansCount = $fansCount;

        return $this;
    }

    /**
     * Get fansCount
     *
     * @return integer
     */
    public function getFansCount()
    {
        return $this->fansCount;
    }

    /**
     * Set boughtCount
     *
     * @param integer $boughtCount
     * @return User
     */
    public function setBoughtCount($boughtCount)
    {
        $this->boughtCount = $boughtCount;

        return $this;
    }

    /**
     * Get boughtCount
     *
     * @return integer
     */
    public function getBoughtCount()
    {
        return $this->boughtCount;
    }

    /**
     * Set soldCount
     *
     * @param integer $soldCount
     * @return User
     */
    public function setSoldCount($soldCount)
    {
        $this->soldCount = $soldCount;

        return $this;
    }

    /**
     * Get soldCount
     *
     * @return integer
     */
    public function getSoldCount()
    {
        return $this->soldCount;
    }

    /**
     * Set likedCount
     *
     * @param integer $likedCount
     * @return User
     */
    public function setLikedCount($likedCount)
    {
        $this->likedCount = $likedCount;

        return $this;
    }

    /**
     * Get likedCount
     *
     * @return integer
     */
    public function getLikedCount()
    {
        return $this->likedCount;
    }

    /**
     * Set orderCount
     *
     * @param integer $orderCount
     * @return User
     */
    public function setOrderCount($orderCount)
    {
        $this->orderCount = $orderCount;

        return $this;
    }

    /**
     * Get orderCount
     *
     * @return integer
     */
    public function getOrderCount()
    {
        return $this->orderCount;
    }

    /**
     * Set messageCount
     *
     * @param integer $messageCount
     * @return User
     */
    public function setMessageCount($messageCount)
    {
        $this->messageCount = $messageCount;

        return $this;
    }

    /**
     * Get messageCount
     *
     * @return integer
     */
    public function getMessageCount()
    {
        return $this->messageCount;
    }

    /**
     * Set messageUnreadCount
     *
     * @param integer $messageUnreadCount
     * @return User
     */
    public function setMessageUnreadCount($messageUnreadCount)
    {
        $this->messageUnreadCount = $messageUnreadCount;

        return $this;
    }

    /**
     * Get messageUnreadCount
     *
     * @return integer
     */
    public function getMessageUnreadCount()
    {
        return $this->messageUnreadCount;
    }

    /**
     * Set argueCount
     *
     * @param integer $argueCount
     * @return User
     */
    public function setArgueCount($argueCount)
    {
        $this->argueCount = $argueCount;

        return $this;
    }

    /**
     * Get argueCount
     *
     * @return integer
     */
    public function getArgueCount()
    {
        return $this->argueCount;
    }

    /**
     * Set breakRuleCount
     *
     * @param integer $breakRuleCount
     * @return User
     */
    public function setBreakRuleCount($breakRuleCount)
    {
        $this->breakRuleCount = $breakRuleCount;

        return $this;
    }

    /**
     * Get breakRuleCount
     *
     * @return integer
     */
    public function getBreakRuleCount()
    {
        return $this->breakRuleCount;
    }

    /**
     * Set storeScore
     *
     * @param integer $storeScore
     * @return User
     */
    public function setStoreScore($storeScore)
    {
        $this->storeScore = $storeScore;

        return $this;
    }

    /**
     * Get storeScore
     *
     * @return integer
     */
    public function getStoreScore()
    {
        return $this->storeScore;
    }

    /**
     * Set argueRatio
     *
     * @param integer $argueRatio
     * @return User
     */
    public function setArgueRatio($argueRatio)
    {
        $this->argueRatio = $argueRatio;

        return $this;
    }

    /**
     * Get argueRatio
     *
     * @return integer
     */
    public function getArgueRatio()
    {
        return $this->argueRatio;
    }

    /**
     * Set breakRuleRatio
     *
     * @param integer $breakRuleRatio
     * @return User
     */
    public function setBreakRuleRatio($breakRuleRatio)
    {
        $this->breakRuleRatio = $breakRuleRatio;

        return $this;
    }

    /**
     * Get breakRuleRatio
     *
     * @return integer
     */
    public function getBreakRuleRatio()
    {
        return $this->breakRuleRatio;
    }

    /**
     * Set intro
     *
     * @param string $intro
     * @return User
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
     * Set contact
     *
     * @param string $contact
     * @return User
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
     * Set wechatId
     *
     * @param string $wechatId
     * @return User
     */
    public function setWechatId($wechatId)
    {
        $this->wechatId = $wechatId;

        return $this;
    }

    /**
     * Get wechatId
     *
     * @return string
     */
    public function getWechatId()
    {
        return $this->wechatId;
    }

    /**
     * Set wechatOpenId
     *
     * @param string $wechatOpenId
     * @return User
     */
    public function setWechatOpenId($wechatOpenId)
    {
        $this->wechatOpenId = $wechatOpenId;

        return $this;
    }

    /**
     * Get wechatOpenId
     *
     * @return string
     */
    public function getWechatOpenId()
    {
        return $this->wechatOpenId;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return User
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
     * @return User
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
     * Set provinceId
     *
     * @param integer $provinceId
     * @return User
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
     * @return User
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
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }



    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return User
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
     * @return User
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
     * Set loginTime
     *
     * @param \DateTime $loginTime
     * @return User
     */
    public function setLoginTime($loginTime)
    {
        $this->loginTime = $loginTime;

        return $this;
    }

    /**
     * Get loginTime
     *
     * @return \DateTime 
     */
    public function getLoginTime()
    {
        return $this->loginTime;
    }
}
