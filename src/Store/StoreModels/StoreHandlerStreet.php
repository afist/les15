<?php
/**
 * Created by PhpStorm.
 * User: Инга
 * Date: 28.05.2018
 * Time: 16:38
 */

namespace App\Store\StoreModels;

use App\Model\Street;

class StoreHandlerStreet extends StoreHandler
{
    /**
     * StoreHandlerStreet constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function findById(int $id)
    {
        $sdh = $this->pdo->prepare('SELECT * FROM streets s WHERE s.id =  :id');
        $sdh->bindParam(':id', $id);
        $sdh->execute();
        $sdh->setFetchMode(\PDO::FETCH_CLASS, \App\Model\Street::class);
        return $sdh->fetch();
    }
    public function create( &$street ):void
    {
        $sdh = $this->pdo->prepare('INSERT INTO streets (district_id, name, type) VALUES (:district_id, :name, :type)');
        $sdh->execute([
            'district_id' => $street->getDistrictId(),
            'name' => $street->getName(),
            'type' => $street->getType(),
        ]);

        $lastId = $this->pdo->lastInsertId();
        $sdh = $this->pdo->prepare('SELECT * FROM streets s WHERE s.id = :id');
        $sdh->execute(['id' => $lastId]);
        $sdh->setFetchMode(\PDO::FETCH_CLASS, \App\Model\Streets::class);
        $street = $sdh->fetch();
    }
    public function update( $street):void
    {
        $sdh = $this->pdo->prepare('UPDATE `streets` s SET `district_id` = :district_id, `name` = :name, `type` = :type  WHERE s.id = :id');
        $sdh->execute(['id' => $street->getId(),'district_id' => $street->getDistrictId(),'name' => $street->getName(),'type' => $street->getType() ]);
    }

    public function delete( $street ):void
    {
        $sdh = $this->pdo->prepare('DELETE FROM streets  WHERE streets.id = :id');
        $sdh->execute([ 'id' => $street->getId() ]);
    }

    public function colectionDistrictId($id):array
    {
        $sdh = $this->pdo->prepare('SELECT * FROM streets WHERE district_id = :id ');
        $sdh->execute(['id' => $id]);
        $sdh->setFetchMode(\PDO::FETCH_ASSOC);
        return $sdh->fetchAll();
    }
    public function colectionRandStreet(int $amount):array
    {
        $sdh = $this->pdo->prepare("SELECT * FROM `streets` ORDER BY RAND() LIMIT {$amount};");
        $sdh->execute();
        $sdh->setFetchMode(\PDO::FETCH_ASSOC);
        return $sdh->fetchAll();
    }
}