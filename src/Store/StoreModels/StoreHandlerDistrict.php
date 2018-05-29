<?php
namespace App\Store\StoreModels;

use App\Model\District;

class StoreHandlerDistrict extends StoreHandler
{
    /**
     * @var \PDO
     */
//    private $pdo;

    /**
     * StoreHandlerDistrict constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * @param int $id
     * @return District
     */
    public function findById(int $id):District
    {
        $sdh = $this->pdo->prepare('SELECT * FROM districts d WHERE d.id =  :id');
        $sdh->bindParam(':id', $id);
        $sdh->execute();
        $sdh->setFetchMode(\PDO::FETCH_CLASS, \App\Model\District::class);
        return = $sdh->fetch();
    }

    /**
     * @param $district
     */
    public function create( &$district ):void
    {
        $sdh = $this->pdo->prepare('INSERT INTO districts (name, population, description) VALUES (:name, :population, :description)');
        $sdh->execute([
            'name' => $district->getName(),
            'population' => $district->getPopulation(),
            'description' => $district->getDescription(),
        ]);

        $lastId = $this->pdo->lastInsertId();
        $sdh = $this->pdo->prepare('SELECT * FROM districts d WHERE d.id = :id');
        $sdh->execute(['id' => $lastId]);
        $sdh->setFetchMode(\PDO::FETCH_CLASS, \App\Model\District::class);
        $district = $sdh->fetch();
    }

    public function update( $district):void
    {
        $sdh = $this->pdo->prepare('UPDATE `districts` d SET `name` = :name, `population` = :population, `description` = :description  WHERE d.id = :id');
        $sdh->execute(['id' => $district->getId(),'name' => $district->getName(),'population' => $district->getPopulation(),'description' => $district->getDescription() ]);
    }

    public function delete( $district ):void
    {
        $sdh = $this->pdo->prepare('DELETE FROM `districts` d WHERE `districts`.`id` = :id');
        $sdh->execute([ 'id' => $district->getId() ]);
    }

    public function colectionPopulation($min, $max = 999999999999):array
    {
        $sdh = $this->pdo->prepare('SELECT * FROM districts WHERE population < :max AND population > :min  ORDER BY population ASC');
        $sdh->execute(['min' => $min, 'max' => $max]);
        $sdh->setFetchMode(\PDO::FETCH_ASSOC);
        return $sdh->fetchAll();
    }
    public function colectionRandDistrict(int $amount):array
    {
        $sdh = $this->pdo->prepare("SELECT * FROM `districts` ORDER BY RAND() LIMIT {$amount};");
        $sdh->execute();
        $sdh->setFetchMode(\PDO::FETCH_ASSOC);
        return $sdh->fetchAll();
    }
}
