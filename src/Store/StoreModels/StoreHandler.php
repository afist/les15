<?php
/**
 * Created by PhpStorm.
 * User: Инга
 * Date: 26.05.2018
 * Time: 10:54
 */

namespace App\Store\StoreModels;

use App\Model\District;

abstract class StoreHandler
{
    protected $pdo;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    abstract public function findById(int $id);
    abstract public function create( &$className): void;
    abstract public function update( $className): void;
    abstract public function delete( $className): void;

}