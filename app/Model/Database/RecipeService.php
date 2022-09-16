<?php declare(strict_types=1);

namespace App\Model\Database;

use App\Model\Database\Entity\Ingredients;
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

  public function create(array $data): array
  {
    $recipe = new Recipes($data['name'], $data['preparation']);
    $this->entityManager->persist($recipe);
    /* ingrediecees are loaded as array ... string to array */
    $ingredientsArray = explode(',',trim($data['ingredients'], '[]/\\ '));
    foreach ($ingredientsArray as $ingred) {
      $ingredient = new Ingredients($ingred);
      $ingredient->setRecipe($recipe);
      $this->entityManager->persist($ingredient);
    }
    $this->entityManager->flush();

    return ['created recepee' => 'Success', 'name' => $data['name']];

  }

  public function get(string $name)
  {
    $recipe = $this->repository->findOneBy(['name' => $name]);
    if ($recipe) {
      return $recipe->getArray();
    }
    return [$name => 'no recipe with this name'];
  }

  private function getOneRecipe(string $name): Recipes
  {
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

  public function delete(string $name): array
  {
    $recipe = $this->getOneRecipe($name);

    $this->entityManager->remove($recipe);
    $this->entityManager->flush();
    if ($recipe){
      return ['delete'=>'Successful'];
    }
    return ['delete' => 'UN Successful'];
  }
}