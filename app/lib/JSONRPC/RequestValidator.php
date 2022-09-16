<?php
declare(strict_types=1);

namespace App\lib\JSONRPC;


class RequestValidator
{


  private array $errors = [];
  private array $requestData;


  public function loadData(array $data): void
  {
    $this->requestData = $data;
  }

  public function validate()
  {
    $method = $this->requestData['method'];
//    FORMAT
    $this->validatePostBody('jsonrpc', ['2.0']);
    $this->validatePostBody('method', ['create', 'get', 'getall', 'delete']);

    $this->lengthValidation('name', 255);


    if ($method === 'delete' || $method === 'get' || $method === 'getall' ){
      $this->validateOptions(['jsonrpc', 'method', 'name']);
    }else{ // only possibility at this point is CREATE
      $this->validateOptions(['jsonrpc', 'method', 'name', 'ingredients']);
      $this->lengthValidation('preparation', 5000);
    }





    return $this->errors;

  }
  private function validatePostBody(string $key, array $expectedValues){
    if (!array_key_exists($key, $this->requestData)) {
      $this->errors[] = ['missing declaration' => $key];
    }else{
      if (! in_array($this->requestData[$key], $expectedValues)){
        $this->errors[] = ['expected value for '. $key => $expectedValues];
      }
    }
  }
  private function lengthValidation(string $key, int $length){
    if (!array_key_exists($key, $this->requestData)) {
      $this->errors[] = ['missing declaration' => $key];
    }else{
      if (strlen($this->requestData[$key]) >= $length) {
        $this->errors[] = ['max length of ' . $key => $length];
      }else if (!$this->requestData[$key]){
        $this->errors[] = [ $key => 'NULL/NONE is not allowed'];
      }
    }
  }

  private function validateOptions(array $expected){
    $keys = array_keys($this->requestData);
    foreach ($keys as $key){
      if (! in_array($key, $expected)){
        $this->errors[] = [ $key => 'not allowed option for chosen method'];
      }
    }
    foreach ($expected as $expec){
      if (! in_array($expec, $keys)){
        $this->errors[] = [ $expec => 'this option is MANDATORY'];
      }
    }
  }
}