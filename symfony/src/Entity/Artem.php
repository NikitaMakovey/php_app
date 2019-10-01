<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtemRepository")
 */
class Artem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $src_image;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $validity_text;

    /**
     * @ORM\Column(type="integer")
     */
    private $validity_length;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end_sale_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getSrcImage(): ?string
    {
        return $this->src_image;
    }

    public function setSrcImage(string $src_image): self
    {
        $this->src_image = $src_image;

        return $this;
    }

    public function getValidityText(): ?string
    {
        return $this->validity_text;
    }

    public function setValidityText(string $validity_text): self
    {
        $this->validity_text = $validity_text;

        return $this;
    }

    public function getValidityLength(): ?int
    {
        return $this->validity_length;
    }

    public function setValidityLength(int $validity_length): self
    {
        $this->validity_length = $validity_length;

        return $this;
    }

    public function getEndSaleDate(): ?\DateTimeInterface
    {
        return $this->end_sale_date;
    }

    public function setEndSaleDate(\DateTimeInterface $end_sale_date): self
    {
        $this->end_sale_date = $end_sale_date;

        return $this;
    }
}
