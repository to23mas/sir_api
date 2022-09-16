<?php

namespace App\Model\Database\Entity;

use Nettrine\ORM\Entity;
/**
 * @ORM\Entity
 * @ORM\Table(name="ingredients")
 */
class Ingredients
{

  /**
   * @ORM\Id
   * @ORM\GeneratedValue()
   * @ORM\Column(name="ing_id", type="integer")
   */
  protected int $id;

   /**
    * @ORM\Column(name="ingr", type="string")
    */
  private string $ingr;



  /**
   * @ORM\ManyToOne(targetEntity="App\Model\Database\Entity\Recipes", inversedBy="ingredients")
   * @ORM\JoinColumn(name="foreign_id", referencedColumnName="rec_id", onDelete="CASCADE")
   */
  private Recipes $recipe;


  /**
   * @param string $ingr
   */
  public function __construct(string $ingr)
  {
    $this->ingr = $ingr;
  }

  /**
   * @return string
   */
  public function getIngr(): string
  {
    return $this->ingr;
  }


  /**
   * @return string
   */
  public function __toString()  : string
  {
    return  $this->getIngr();
  }

  /**
   * @param Recipes $recipe
   */
  public function setRecipe(Recipes $recipe): void
  {
    $this->recipe = $recipe;
  }

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }






}