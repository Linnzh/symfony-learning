<?php

namespace App\Entity;

use App\Repository\TestMessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Entity(repositoryClass=TestMessageRepository::class)
 * @ORM\Table(options={"comment"="测试Message"}, indexes={@Index(name="search_idx", columns={"number"})})
 */
class TestMessage implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_at;

    /**
     * @ORM\Column(type="string", length=64, options={"default"="", "comment"="编号"})
     */
    private $number = '';

    /**
     * @ORM\Column(type="string", length=255, options={"default"="", "comment"="名称"})
     */
    private $name = '';

    /**
     * @ORM\Column(type="boolean", options={"default"=true, "comment"="是否为激活状态"})
     */
    private $is_active = true;

    /**
     * @ORM\Column(type="integer", options={"default"=0, "comment"="状态码"})
     */
    private $status = 0;

    public function __construct()
    {
        $this->create_at = new \DateTime();
        $this->update_at = new \DateTime();
    }

    public function jsonSerialize(): array
    {
        // TODO: Implement jsonSerialize() method.
        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'is_active' => $this->is_active,
            'status' => $this->status,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
