<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Track;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTrackData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $track1 = new Track();
        $track1->setTitle('Song');
        $track1->setArtist($this->getReference('artist1'));


        $track2 = new Track();
        $track2->setTitle('Other Song');
        $track2->setArtist($this->getReference('artist2'));

        $manager->persist($track1);
        $manager->persist($track2);

        $this->addReference('track1', $track1);
        $this->addReference('track2', $track2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}