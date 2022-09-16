<?php

namespace App\Model\Database\Entity;

use Doctrine\ORM\Mapping as ORM;

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
   * @ORM\JoinColumn(name="foreign_id", referencedColumnName="rec_id")
   */
  private Recipes $recipes;


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
   * @param string $ingr
   */
  public function setIngr(string $ingr): void
  {
    $this->ingr = $ingr;
  }




}