<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Sylius\Component\Core\Model\Customer;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\Order;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="arobases_sylius_rights_management_right")
 */

class Right implements ResourceInterface {

    use TimestampableEntity;

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
     * @ORM\ManyToMany(targetEntity="Arobases\SyliusRightsManagementPlugin\Entity\Role",
     *     inversedBy="rights",
     *     fetch="EXTRA_LAZY",
     *      cascade={"persist", "remove"}
     * )
     *
     */
    protected Collection $roles;


    /**
     * @ORM\ManyToOne(targetEntity="Arobases\SyliusRightsManagementPlugin\Entity\RightGroup",
     *     inversedBy="rights",
     *     fetch="EXTRA_LAZY",
     *      cascade={"persist", "remove"}
     * )
     */
    protected ?RightGroup $rightGroup = null;

    /**
     * @ORM\Column(type="array", length=511, nullable=true)
     */
     protected ?array $routes = null;

    /**
     * @ORM\Column(type="array", length=511, nullable=true)
     */
    protected ?array $excludedRoutes = null;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected ?string $redirectTo = null;

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
     * @return Role|null
     */
    public function getAdministrationRole(): ?Role
    {
        return $this->administrationRole;
    }

    /**
     * @param Role|null $administrationRole
     */
    public function setAdministrationRole(?Role $administrationRole): void
    {
        $this->administrationRole = $administrationRole;
    }

    /**
     * @return RightGroup|null
     */
    public function getRightGroup(): ?RightGroup
    {
        return $this->rightGroup;
    }

    /**
     * @param RightGroup|null $rightGroup
     */
    public function setRightGroup(?RightGroup $rightGroup): void
    {
        $this->rightGroup = $rightGroup;
    }

    /**
     * @return array|null
     */
    public function getRoutes(): ?array
    {
        return $this->routes;
    }

    /**
     * @param array|null $routes
     */
    public function setRoutes(?array $routes): void
    {
        $this->routes = $routes;
    }

    /**
     * @return string|null
     */
    public function getRedirectTo(): ?string
    {
        return $this->redirectTo;
    }

    /**
     * @param string|null $redirectTo
     */
    public function setRedirectTo(?string $redirectTo): void
    {
        $this->redirectTo = $redirectTo;
    }

    /**
     * @return array|null
     */
    public function getExcludedRoutes(): ?array
    {
        return $this->excludedRoutes;
    }

    /**
     * @param array|null $excludedRoutes
     */
    public function setExcludedRoutes(?array $excludedRoutes): void
    {
        $this->excludedRoutes = $excludedRoutes;
    }





}
