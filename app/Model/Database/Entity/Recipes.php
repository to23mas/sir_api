<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Nettrine\ORM\Entity;
/**
 * @ORM\Entity
 * @ORM\Table(name="recipes")
 */
class Recipes {

  /**
   * @ORM\Id
   * @ORM\GeneratedValue()
   * @ORM\Column(name="rec_id", type="integer")
   */
  protected int $id;

   /**
    * @ORM\Column(name="name", type="string")
    */
  private string $name;

  /**
   * @ORM\Column(name="preparation", type="string", length=5000)
   */
  private string $preparation;

  /**
   * @ORM\OneToMany(targetEntity="App\Model\Database\Entity\Ingredients", mappedBy="recipe")
   */
  private Collection $ingredients;


  /**
   * @param string $name
   * @param string $preparation
   */
  public function __construct(string $name, string $preparation)
  {
    $this->name = $name;
    $this->preparation = $preparation;
    $this->ingredients= new ArrayCollection();
  }

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
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
   * @return string
   */
  public function getPreparation(): string
  {
    return $this->preparation;
  }

  /**
   * @param string $preparation
   */
  public function setPreparation(string $preparation): void
  {
    $this->preparation = $preparation;
  }

  /**
   * @param Ingredients $ingredients
   */
  public function addIngredients(Ingredients $ingredients): void
  {
    $this->ingredients[] = $ingredients;
  }


  /**
   * @return array
   */
  public function getIngredientsAsArray(): array
  {
    return $this->ingredients->getValues();
  }
  /**
   * @return array
   */
  public function getArray(): array
  {
    $arrayA = [];
    foreach ($this->ingredients as $i){
      $arrayA [] = $i->getIngr();
    }
    return [
      'name' => $this->getName(),
      'preparation process' => $this->getPreparation(),
      'ingredients' => $arrayA
    ];
  }


}
