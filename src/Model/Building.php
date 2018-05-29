<?php
/**
 * Created by PhpStorm.
 * User: Инга
 * Date: 28.05.2018
 * Time: 20:36
 */

namespace App\Model;


class Building
{
    private $id;
    private $street_id;
    private $number;
    private $count_flat;
    private $count_floor;

    /**
     * @return mixed
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStreetId ()
    {
        return $this->street_id;
    }

    /**
     * @param mixed $street_id
     */
    public function setStreetId ($street_id): void
    {
        $this->street_id = $street_id;
    }

    /**
     * @return mixed
     */
    public function getNumber ()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber ($number): void
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getCountFlat ()
    {
        return $this->count_flat;
    }

    /**
     * @param mixed $count_flat
     */
    public function setCountFlat ($count_flat): void
    {
        $this->count_flat = $count_flat;
    }

    /**
     * @return mixed
     */
    public function getCountFloor ()
    {
        return $this->count_floor;
    }

    /**
     * @param mixed $count_floor
     */
    public function setCountFloor ($count_floor): void
    {
        $this->count_floor = $count_floor;
    }


}