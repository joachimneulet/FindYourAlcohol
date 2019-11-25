<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CocktailRepository")
 */
class Cocktail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameCocktail;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instructions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ingredients;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbnailURL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCocktail(): ?string
    {
        return $this->nameCocktail;
    }

    public function setNameCocktail(string $nameCocktail): self
    {
        $this->nameCocktail = $nameCocktail;

        return $this;
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }

    public function setIdCategory(int $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(?string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(?string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getThumbnailURL(): ?string
    {
        return $this->thumbnailURL;
    }

    public function setThumbnailURL(?string $thumbnailURL): self
    {
        $this->thumbnailURL = $thumbnailURL;

        return $this;
    }
}
