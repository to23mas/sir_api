<?php

declare(strict_types=1);

namespace App\Presenters;

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
    $this->sendJson([$this->data]);

  }

}