<?php

declare(strict_types=1);

namespace App\Presenters;

use App\lib\JSONRPC\RequestValidator;
use App\Model\Database\RecipeService;
use Nette;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{

  /** @var RecipeService @inject */
  public RecipeService $recipeService;

  /** @var RequestValidator @inject */
  public RequestValidator $requestValidator;

  public function actionDefault(): void
  {

  //  loading request
    $request = $this->getHttpRequest();

    if ($request->isMethod('POST')) {
      $data = $request->getPost();

      $this->requestValidator->loadData($data);
      $errors = $this->requestValidator->validate();

      /* Pokud chyba v Jsonu odešlou se všechny nalezený chyby */
      if ($errors) {
        $this->sendJson([$errors]);
      }
      if ($data['method'] === 'getall'){
        $data = $this->recipeService->getall();
//        $this->sendJson([$data]);
      }else if ($data['method'] === 'get'){
        $data = $this->recipeService->get($data['name']);
      }else if ($data['method'] === 'delete'){
        $data = $this->recipeService->delete($data['name']);
      }


      $this->sendJson([$data]);
    }
  }


  public function renderDefault():void { $this->redirect('Homepage:BadMethod'); }

  public function renderBadMethod() : void{}

}