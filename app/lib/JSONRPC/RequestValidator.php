<?php
declare(strict_types=1);

namespace App\lib\JSONRPC;


class RequestValidator
{


  private array $errors = [];
  private array $validMethods = ['create', 'get', 'getall', 'delete'];
  private array $requestData;


  public function loadData(array $data): void
  {
    $this->requestData = $data;
  }

  public function validate()
  {
//    FORMAT
    if (!array_key_exists('jsonrpc', $this->requestData)) {
      $this->errors[] = 'you should use JSONRPC';
    }
//     METHOD
    if (!array_key_exists('method', $this->requestData)) {
      $this->errors[] = 'select valid method';
    } else {
      if (!in_array($this->requestData['method'], $this->validMethods)) {
        $this->errors[] = 'Invalid method selected';
      }
    }
// EMPTY
    if ($this->errors) {
      return $this->errors;
    }

    if ($this->requestData['method'] === 'get' || $this->requestData['method'] === 'delete') {
      if (!array_key_exists('name', $this->requestData)) {
        $this->errors[] = 'using get method should use "name"';
      }
    } else if ($this->requestData['method'] === 'getall') {
      return $this->errors;
    } else if ($this->requestData['memthod'] === 'create') {
      return false;
//      TODO
    }
    return $this->errors;

  }

}