<?php
// https://symfony.com/doc/current/security/guard_authentication.html
// https://symfony.com/doc/current/security/entity_provider.html
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="app_user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $l_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $f_name;

    /**
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tk;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roles;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
	private $isActive;

    public function __construct($isActive) {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }


    public function getSalt()
    {
    }
    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
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

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }

    //===========================================

    public function getId()
    {
        return $this->id;
    }

    public function getLName(): ?string
    {
        return $this->l_name;
    }

    public function setLName(?string $l_name): self
    {
        $this->l_name = $l_name;

        return $this;
    }

    public function getFName(): ?string
    {
        return $this->f_name;
    }

    public function setFName(?string $f_name): self
    {
        $this->f_name = $f_name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTk(): ?string
    {
        return $this->tk;
    }

    public function setTk(?string $tk): self
    {
        $this->tk = $tk;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(?string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

	/**
	 * Get the value of isActive
	 */ 
	public function getIsActive()
	{
		return $this->isActive;
	}

	/**
	 * Set the value of isActive
	 *
	 * @return  self
	 */ 
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;

		return $this;
	}
}
