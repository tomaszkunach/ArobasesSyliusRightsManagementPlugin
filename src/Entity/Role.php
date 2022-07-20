<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="arobases_sylius_right_management_role")
 */

class Role implements ResourceInterface, CodeAwareInterface {

    use TimestampableEntity;
    /**
     * @ORM\Column(type="string", length=70)
     */
    protected ?string $code = null;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $name;

    /**
     * @ORM\ManyToMany(targetEntity="Arobases\SyliusRightsManagementPlugin\Entity\Right",
     *     mappedBy="roles", fetch="EXTRA_LAZY")
     *
     * @ORM\JoinTable(name="arobases_sylius_rights_management_right_role",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="right_id", referencedColumnName="id")}
     *      )
     */
    protected Collection $rights;

    /**
     * @ORM\OneToMany(targetEntity="Sylius\Component\Core\Model\AdminUserInterface",
     *     mappedBy="role", fetch="EXTRA_LAZY",
     *     cascade={"persist", "remove"}
     *      )
     */

    protected Collection $adminUsers;


    public function __construct()
    {
        $this->rights = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection
     */
    public function getRights(): Collection
    {
        return $this->rights;
    }

    public function addRight(Right $right): self
    {
        if (!$this->rights->contains($right)) {
            $this->rights[] = $right;
            $right->addRole($this);
        }
        return $this;
    }
    public function removeRight(Right $right): self
    {
        if ($this->rights->removeElement($right)) {
            $right->removeRole($this);
        }
        return $this;
    }


    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
