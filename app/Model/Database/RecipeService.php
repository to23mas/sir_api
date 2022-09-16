<?php declare(strict_types=1);

namespace App\Model\Database;

use App\Model\Database\Entity\Recipes;
use Doctrine\ORM\EntityRepository;
use Nettrine\ORM\EntityManagerDecorator;


class RecipeService
{
  protected EntityManagerDecorator $entityManager;
  protected EntityRepository $repository;

  public function __construct(EntityManagerDecorator $entityManagerDecorator)
  {
    $this->entityManager = $entityManagerDecorator;
    $this->repository = $entityManagerDecorator->getRepository(Recipes::class);
  }



  public function create(array $data) : void
  {
    // TODO ****************************

  }

  public function get(string $name)
  {
    $recipe = $this->repository->findOneBy(['name' => $name]);
    return $recipe->getArray();
  }

  private function getOneRecipe(string $name): Recipes{
    return $this->repository->findOneBy(['name' => $name]);
  }

  public function getAll()
  {
    $recipes = $this->repository->findAll();
    $asArray = [];

    foreach($recipes as $recipe) {
      $asArray [] = $recipe->getArray();
    }
    return $asArray;
  }

  public function delete(string $name)
  {
    $recipe = $this->getOneRecipe($name);

    $this->entityManager->remove($recipe);
    $this->entityManager->flush();
  }
}