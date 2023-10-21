<?php

namespace App\Entity\Oysterpro;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FosUserUser
 *
 * @ORM\Table(name="fos_user_user", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_C560D76192FC23A8", columns={"username_canonical"}), @ORM\UniqueConstraint(name="UNIQ_C560D761A0D96FBF", columns={"email_canonical"})})
 * @ORM\Entity
 */
class FosUserUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="username_canonical", type="string", length=255, nullable=false)
     */
    private $usernameCanonical;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="email_canonical", type="string", length=255, nullable=false)
     */
    private $emailCanonical;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var bool
     *
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    private $locked;

    /**
     * @var bool
     *
     * @ORM\Column(name="expired", type="boolean", nullable=false)
     */
    private $expired;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    private $expiresAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="confirmation_token", type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="password_requested_at", type="datetime", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", length=0, nullable=false)
     */
    private $roles;

    /**
     * @var bool
     *
     * @ORM\Column(name="credentials_expired", type="boolean", nullable=false)
     */
    private $credentialsExpired;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="credentials_expire_at", type="datetime", nullable=true)
     */
    private $credentialsExpireAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_of_birth", type="datetime", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=64, nullable=true)
     */
    private $firstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=64, nullable=true)
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="string", length=64, nullable=true)
     */
    private $website;

    /**
     * @var string|null
     *
     * @ORM\Column(name="biography", type="string", length=1000, nullable=true)
     */
    private $biography;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=true)
     */
    private $gender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="locale", type="string", length=8, nullable=true)
     */
    private $locale;

    /**
     * @var string|null
     *
     * @ORM\Column(name="timezone", type="string", length=64, nullable=true)
     */
    private $timezone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=64, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facebook_uid", type="string", length=255, nullable=true)
     */
    private $facebookUid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facebook_name", type="string", length=255, nullable=true)
     */
    private $facebookName;

    /**
     * @var array|null
     *
     * @ORM\Column(name="facebook_data", type="json", nullable=true)
     */
    private $facebookData;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twitter_uid", type="string", length=255, nullable=true)
     */
    private $twitterUid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twitter_name", type="string", length=255, nullable=true)
     */
    private $twitterName;

    /**
     * @var array|null
     *
     * @ORM\Column(name="twitter_data", type="json", nullable=true)
     */
    private $twitterData;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gplus_uid", type="string", length=255, nullable=true)
     */
    private $gplusUid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gplus_name", type="string", length=255, nullable=true)
     */
    private $gplusName;

    /**
     * @var array|null
     *
     * @ORM\Column(name="gplus_data", type="json", nullable=true)
     */
    private $gplusData;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var string|null
     *
     * @ORM\Column(name="two_step_code", type="string", length=255, nullable=true)
     */
    private $twoStepCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="FosUserGroup", inversedBy="user")
     * @ORM\JoinTable(name="fos_user_user_group",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     *   }
     * )
     */
    private $group = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->group = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsernameCanonical(): ?string
    {
        return $this->usernameCanonical;
    }

    public function setUsernameCanonical(string $usernameCanonical): self
    {
        $this->usernameCanonical = $usernameCanonical;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailCanonical(): ?string
    {
        return $this->emailCanonical;
    }

    public function setEmailCanonical(string $emailCanonical): self
    {
        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function isLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): self
    {
        $this->locked = $locked;

        return $this;
    }

    public function isExpired(): ?bool
    {
        return $this->expired;
    }

    public function setExpired(bool $expired): self
    {
        $this->expired = $expired;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getPasswordRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }

    public function setPasswordRequestedAt(?\DateTimeInterface $passwordRequestedAt): self
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function isCredentialsExpired(): ?bool
    {
        return $this->credentialsExpired;
    }

    public function setCredentialsExpired(bool $credentialsExpired): self
    {
        $this->credentialsExpired = $credentialsExpired;

        return $this;
    }

    public function getCredentialsExpireAt(): ?\DateTimeInterface
    {
        return $this->credentialsExpireAt;
    }

    public function setCredentialsExpireAt(?\DateTimeInterface $credentialsExpireAt): self
    {
        $this->credentialsExpireAt = $credentialsExpireAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(?string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFacebookUid(): ?string
    {
        return $this->facebookUid;
    }

    public function setFacebookUid(?string $facebookUid): self
    {
        $this->facebookUid = $facebookUid;

        return $this;
    }

    public function getFacebookName(): ?string
    {
        return $this->facebookName;
    }

    public function setFacebookName(?string $facebookName): self
    {
        $this->facebookName = $facebookName;

        return $this;
    }

    public function getFacebookData(): ?array
    {
        return $this->facebookData;
    }

    public function setFacebookData(?array $facebookData): self
    {
        $this->facebookData = $facebookData;

        return $this;
    }

    public function getTwitterUid(): ?string
    {
        return $this->twitterUid;
    }

    public function setTwitterUid(?string $twitterUid): self
    {
        $this->twitterUid = $twitterUid;

        return $this;
    }

    public function getTwitterName(): ?string
    {
        return $this->twitterName;
    }

    public function setTwitterName(?string $twitterName): self
    {
        $this->twitterName = $twitterName;

        return $this;
    }

    public function getTwitterData(): ?array
    {
        return $this->twitterData;
    }

    public function setTwitterData(?array $twitterData): self
    {
        $this->twitterData = $twitterData;

        return $this;
    }

    public function getGplusUid(): ?string
    {
        return $this->gplusUid;
    }

    public function setGplusUid(?string $gplusUid): self
    {
        $this->gplusUid = $gplusUid;

        return $this;
    }

    public function getGplusName(): ?string
    {
        return $this->gplusName;
    }

    public function setGplusName(?string $gplusName): self
    {
        $this->gplusName = $gplusName;

        return $this;
    }

    public function getGplusData(): ?array
    {
        return $this->gplusData;
    }

    public function setGplusData(?array $gplusData): self
    {
        $this->gplusData = $gplusData;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getTwoStepCode(): ?string
    {
        return $this->twoStepCode;
    }

    public function setTwoStepCode(?string $twoStepCode): self
    {
        $this->twoStepCode = $twoStepCode;

        return $this;
    }

    /**
     * @return Collection<int, FosUserGroup>
     */
    public function getGroup(): Collection
    {
        return $this->group;
    }

    public function addGroup(FosUserGroup $group): self
    {
        if (!$this->group->contains($group)) {
            $this->group[] = $group;
        }

        return $this;
    }

    public function removeGroup(FosUserGroup $group): self
    {
        $this->group->removeElement($group);

        return $this;
    }

}
