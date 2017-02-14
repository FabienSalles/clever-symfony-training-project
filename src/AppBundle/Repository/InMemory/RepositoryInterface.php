<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 14/02/17
 * Time: 10:39
 */

namespace AppBundle\Repository\InMemory;

interface RepositoryInterface
{
    public function find($id);
    public function findAll() : array;
}
