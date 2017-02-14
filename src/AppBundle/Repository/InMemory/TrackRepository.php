<?php

namespace AppBundle\Repository\InMemory;

class TrackRepository implements  RepositoryInterface
{
    public static $tracks = [
        [
            'id'     => 2,
            'title'  => 'Eversort',
            'artist' => 5,
        ],
        [
            'id'     => 123,
            'title'  => 'Everlong',
            'artist' => 1,
        ],
    ];

    public function find($id)
    {
        $key  = array_search($id, array_column(self::$tracks, 'id'));

        if (false === $key) {
            throw new NotFoundException();
        }

        return self::$tracks[$key];
    }

    public function findAll() : array
    {
        return self::$tracks;
    }
}
