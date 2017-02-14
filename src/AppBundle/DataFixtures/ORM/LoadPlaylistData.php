<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 22/11/16
 * Time: 16:21
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Playlist;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPlaylistData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $playList1 = new Playlist();
        $playList1->addTrack($this->getReference('track1'));
        $playList1->addTrack($this->getReference('track2'));
        $manager->persist($playList1);

        $playList2 = new Playlist();
        $manager->persist($playList2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}