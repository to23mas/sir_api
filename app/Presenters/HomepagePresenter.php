<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Database\RecipeService;
use Nette;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{

  /** @var RecipeService @inject */
  public RecipeService $recipeService;


  public function actionDefault(): void
  {

  //  loading request
    $request = $this->getHttpRequest();

    if ($request->isMethod('POST')) {
      $data = $request->getPost();
      $this->sendJson([$data]);
    }
  }


  public function renderDefault():void { $this->redirect('Homepage:BadMethod'); }

  public function renderBadMethod() : void{}

}