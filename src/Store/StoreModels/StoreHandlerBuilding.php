<?php
/**
 * Created by PhpStorm.
 * User: Инга
 * Date: 28.05.2018
 * Time: 19:29
 */

namespace App\Store\StoreModels;

use App\Model\Building;


class StoreHandlerBuilding extends StoreHandler
{
    /**
     * StoreHandlerBuilding constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }
    public function findById(int $id)
    {
        $sdh = $this->pdo->prepare('SELECT * FROM buildings b WHERE b.id =  :id');
        $sdh->bindParam(':id', $id);
        $sdh->execute();
        $sdh->setFetchMode(\PDO::FETCH_CLASS, \App\Model\Building::class);
        return $sdh->fetch();
    }
    public function create( &$building ):void
    {
        $sdh = $this->pdo->prepare('INSERT INTO buildings (street_id, number, count_flat, count_floor) VALUES (:street_id, :number, :count_flat, :count_floor)');
        $sdh->execute([
            'street_id' => $building->getStreetId(),
            'number' => $building->getNumber(),
            'count_flat' => $building->getCountFlat(),
            'count_floor' => $building->getCountFloor(),
        ]);

        $lastId = $this->pdo->lastInsertId();
        $sdh = $this->pdo->prepare('SELECT * FROM buildings b WHERE b.id = :id');
        $sdh->execute(['id' => $lastId]);
        $sdh->setFetchMode(\PDO::FETCH_CLASS, \App\Model\Building::class);
        $building = $sdh->fetch();
    }
    public function update( $building):void
    {
        $sdh = $this->pdo->prepare('UPDATE `buildings` b SET `street_id` = :street_id, `number` = :number, `count_flat` = :count_flat, count_floor = :count_floor  WHERE b.id = :id');
        $sdh->execute(['id' => $building->getId(),
                      'street_id' => $building->getStreetId(),
                      'number' => $building->getNumber(),
                      'count_flat' => $building->getCountFlat(),
                      'count_floor'=> $building->getCountFloor()
        ]);

    }

    public function delete( $building ):void
    {
        $sdh = $this->pdo->prepare('DELETE FROM buildings  WHERE buildings.id = :id');
        $sdh->execute([ 'id' => $building->getId() ]);
    }

    public function colectionStreetId($id):array
    {
        $sdh = $this->pdo->prepare('SELECT * FROM buildings WHERE street_id = :id ');
        $sdh->execute(['id' => $id]);
        $sdh->setFetchMode(\PDO::FETCH_ASSOC);
        return $sdh->fetchAll();
    }
    public function colectionRandBuildings(int $amount):array
    {
        $sdh = $this->pdo->prepare("SELECT * FROM `buildings` ORDER BY RAND() LIMIT {$amount};");
        $sdh->execute();
        $sdh->setFetchMode(\PDO::FETCH_ASSOC);
        return $sdh->fetchAll();
    }
}