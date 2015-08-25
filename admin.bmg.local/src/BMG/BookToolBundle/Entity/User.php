<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="user_email_UNIQUE", columns={"user_email"})}, indexes={@ORM\Index(name="fk_user_status1_idx", columns={"status_id"}), @ORM\Index(name="fk_user_city1_idx", columns={"city_id"}), @ORM\Index(name="fk_user_hear_about1_idx", columns={"hear_about_id"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=245, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=255, nullable=false)
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="user_sms_verification_code", type="string", length=10, nullable=true)
     */
    private $userSmsVerificationCode;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstname", type="string", length=45, nullable=false)
     */
    private $userFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_lastname", type="string", length=45, nullable=false)
     */
    private $userLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_address1", type="string", length=45, nullable=true)
     */
    private $userAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="user_address2", type="string", length=45, nullable=true)
     */
    private $userAddress2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_birthdate", type="date", nullable=true)
     */
    private $userBirthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="user_zipcode", type="string", length=5, nullable=true)
     */
    private $userZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mobile", type="string", length=10, nullable=true)
     */
    private $userMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_half_day", type="boolean", nullable=true)
     */
    private $userHalfDay;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_willing_to_travel", type="boolean", nullable=true)
     */
    private $userWillingToTravel;

    /**
     * @var string
     *
     * @ORM\Column(name="user_website", type="string", length=245, nullable=true)
     */
    private $userWebsite;

    /**
     * @var string
     *
     * @ORM\Column(name="user_notes", type="string", length=500, nullable=true)
     */
    private $userNotes;

    /**
     * @var string
     *
     * @ORM\Column(name="user_ip", type="string", length=15, nullable=false)
     */
    private $userIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_create_datetime", type="datetime", nullable=false)
     */
    private $userCreateDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_lastupdate_datetime", type="datetime", nullable=true)
     */
    private $userLastupdateDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="user_gender", type="string", length=1, nullable=true)
     */
    private $userGender;

    /**
     * @var string
     *
     * @ORM\Column(name="user_bio", type="text", nullable=true)
     */
    private $userBio;

    /**
     * @var string
     *
     * @ORM\Column(name="user_photo", type="string", length=200, nullable=true)
     */
    private $userPhoto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_admin", type="boolean", nullable=false)
     */
    private $userAdmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var \BMG\BookToolBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

    /**
     * @var \BMG\BookToolBundle\Entity\HearAbout
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\HearAbout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hear_about_id", referencedColumnName="hear_about_id")
     * })
     */
    private $hearAbout;

    /**
     * @var \BMG\BookToolBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;



    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userSmsVerificationCode
     *
     * @param string $userSmsVerificationCode
     * @return User
     */
    public function setUserSmsVerificationCode($userSmsVerificationCode)
    {
        $this->userSmsVerificationCode = $userSmsVerificationCode;

        return $this;
    }

    /**
     * Get userSmsVerificationCode
     *
     * @return string 
     */
    public function getUserSmsVerificationCode()
    {
        return $this->userSmsVerificationCode;
    }

    /**
     * Set userFirstname
     *
     * @param string $userFirstname
     * @return User
     */
    public function setUserFirstname($userFirstname)
    {
        $this->userFirstname = $userFirstname;

        return $this;
    }

    /**
     * Get userFirstname
     *
     * @return string 
     */
    public function getUserFirstname()
    {
        return $this->userFirstname;
    }

    /**
     * Set userLastname
     *
     * @param string $userLastname
     * @return User
     */
    public function setUserLastname($userLastname)
    {
        $this->userLastname = $userLastname;

        return $this;
    }

    /**
     * Get userLastname
     *
     * @return string 
     */
    public function getUserLastname()
    {
        return $this->userLastname;
    }

    /**
     * Set userAddress1
     *
     * @param string $userAddress1
     * @return User
     */
    public function setUserAddress1($userAddress1)
    {
        $this->userAddress1 = $userAddress1;

        return $this;
    }

    /**
     * Get userAddress1
     *
     * @return string 
     */
    public function getUserAddress1()
    {
        return $this->userAddress1;
    }

    /**
     * Set userAddress2
     *
     * @param string $userAddress2
     * @return User
     */
    public function setUserAddress2($userAddress2)
    {
        $this->userAddress2 = $userAddress2;

        return $this;
    }

    /**
     * Get userAddress2
     *
     * @return string 
     */
    public function getUserAddress2()
    {
        return $this->userAddress2;
    }

    /**
     * Set userBirthdate
     *
     * @param \DateTime $userBirthdate
     * @return User
     */
    public function setUserBirthdate($userBirthdate)
    {
        $this->userBirthdate = $userBirthdate;

        return $this;
    }

    /**
     * Get userBirthdate
     *
     * @return \DateTime 
     */
    public function getUserBirthdate()
    {
        return $this->userBirthdate;
    }

    /**
     * Set userZipcode
     *
     * @param string $userZipcode
     * @return User
     */
    public function setUserZipcode($userZipcode)
    {
        $this->userZipcode = $userZipcode;

        return $this;
    }

    /**
     * Get userZipcode
     *
     * @return string 
     */
    public function getUserZipcode()
    {
        return $this->userZipcode;
    }

    /**
     * Set userMobile
     *
     * @param string $userMobile
     * @return User
     */
    public function setUserMobile($userMobile)
    {
        $this->userMobile = $userMobile;

        return $this;
    }

    /**
     * Get userMobile
     *
     * @return string 
     */
    public function getUserMobile()
    {
        return $this->userMobile;
    }

    /**
     * Set userHalfDay
     *
     * @param boolean $userHalfDay
     * @return User
     */
    public function setUserHalfDay($userHalfDay)
    {
        $this->userHalfDay = $userHalfDay;

        return $this;
    }

    /**
     * Get userHalfDay
     *
     * @return boolean 
     */
    public function getUserHalfDay()
    {
        return $this->userHalfDay;
    }

    /**
     * Set userWillingToTravel
     *
     * @param boolean $userWillingToTravel
     * @return User
     */
    public function setUserWillingToTravel($userWillingToTravel)
    {
        $this->userWillingToTravel = $userWillingToTravel;

        return $this;
    }

    /**
     * Get userWillingToTravel
     *
     * @return boolean 
     */
    public function getUserWillingToTravel()
    {
        return $this->userWillingToTravel;
    }

    /**
     * Set userWebsite
     *
     * @param string $userWebsite
     * @return User
     */
    public function setUserWebsite($userWebsite)
    {
        $this->userWebsite = $userWebsite;

        return $this;
    }

    /**
     * Get userWebsite
     *
     * @return string 
     */
    public function getUserWebsite()
    {
        return $this->userWebsite;
    }

    /**
     * Set userNotes
     *
     * @param string $userNotes
     * @return User
     */
    public function setUserNotes($userNotes)
    {
        $this->userNotes = $userNotes;

        return $this;
    }

    /**
     * Get userNotes
     *
     * @return string 
     */
    public function getUserNotes()
    {
        return $this->userNotes;
    }

    /**
     * Set userIp
     *
     * @param string $userIp
     * @return User
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * Get userIp
     *
     * @return string 
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Set userCreateDatetime
     *
     * @param \DateTime $userCreateDatetime
     * @return User
     */
    public function setUserCreateDatetime($userCreateDatetime)
    {
        $this->userCreateDatetime = $userCreateDatetime;

        return $this;
    }

    /**
     * Get userCreateDatetime
     *
     * @return \DateTime 
     */
    public function getUserCreateDatetime()
    {
        return $this->userCreateDatetime;
    }

    /**
     * Set userLastupdateDatetime
     *
     * @param \DateTime $userLastupdateDatetime
     * @return User
     */
    public function setUserLastupdateDatetime($userLastupdateDatetime)
    {
        $this->userLastupdateDatetime = $userLastupdateDatetime;

        return $this;
    }

    /**
     * Get userLastupdateDatetime
     *
     * @return \DateTime 
     */
    public function getUserLastupdateDatetime()
    {
        return $this->userLastupdateDatetime;
    }

    /**
     * Set userGender
     *
     * @param string $userGender
     * @return User
     */
    public function setUserGender($userGender)
    {
        $this->userGender = $userGender;

        return $this;
    }

    /**
     * Get userGender
     *
     * @return string 
     */
    public function getUserGender()
    {
        return $this->userGender;
    }

    /**
     * Set userBio
     *
     * @param string $userBio
     * @return User
     */
    public function setUserBio($userBio)
    {
        $this->userBio = $userBio;

        return $this;
    }

    /**
     * Get userBio
     *
     * @return string 
     */
    public function getUserBio()
    {
        return $this->userBio;
    }

    /**
     * Set userPhoto
     *
     * @param string $userPhoto
     * @return User
     */
    public function setUserPhoto($userPhoto)
    {
        $this->userPhoto = $userPhoto;

        return $this;
    }

    /**
     * Get userPhoto
     *
     * @return string 
     */
    public function getUserPhoto()
    {
        return $this->userPhoto;
    }

    /**
     * Set userAdmin
     *
     * @param boolean $userAdmin
     * @return User
     */
    public function setUserAdmin($userAdmin)
    {
        $this->userAdmin = $userAdmin;

        return $this;
    }

    /**
     * Get userAdmin
     *
     * @return boolean 
     */
    public function getUserAdmin()
    {
        return $this->userAdmin;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return User
     */
    public function setStatus(\BMG\BookToolBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \BMG\BookToolBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set hearAbout
     *
     * @param \BMG\BookToolBundle\Entity\HearAbout $hearAbout
     * @return User
     */
    public function setHearAbout(\BMG\BookToolBundle\Entity\HearAbout $hearAbout = null)
    {
        $this->hearAbout = $hearAbout;

        return $this;
    }

    /**
     * Get hearAbout
     *
     * @return \BMG\BookToolBundle\Entity\HearAbout 
     */
    public function getHearAbout()
    {
        return $this->hearAbout;
    }

    /**
     * Set city
     *
     * @param \BMG\BookToolBundle\Entity\City $city
     * @return User
     */
    public function setCity(\BMG\BookToolBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \BMG\BookToolBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
    
    public function __toString() {
    	return $this->getUserFirstname() . ' ' . $this->getUserLastname();
    }
}
