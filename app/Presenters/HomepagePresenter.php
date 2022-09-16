<?php

declare(strict_types=1);

namespace App\Presenters;

use JetBrains\PhpStorm\NoReturn;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

  public array $data = [
    'ket' => 'value',
    '1' => 1,
    2 => 'hello',
    'nested' => [
      1 => 1,
      2 => 2,
      3 => [1,2,3,4,5,6,7,8,9]
    ]
  ];


  public function actionDefault(): void
  {

  //  loading request
    $request = $this->getHttpRequest();

    if ($request->isMethod('POST')) {
      $data = $request->getPost();
      $this->sendJson([$data]);
    }
  }


  #[NoReturn] public function renderDefault():void { $this->redirect('Homepage:BadMethod'); }

  #[NoReturn] public function renderBadMethod() : void{}

}