<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Artist;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadArtistData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artist1 = new Artist();
        $artist1->setGenre('Rock');
        $artist1->setType('band');
        $artist1->setName('Muse');
        $artist1->setPicture('https://tse2.mm.bing.net/th?id=OIP.M4a73fb3bc34b18d47097cb1f28f847aco0&pid=15.1&P=0&w=290&h=165');

        $artist2 = new Artist();
        $artist2->setGenre('Hard Rock');
        $artist2->setType('band');
        $artist2->setName('ACDC');
        $artist2->setPicture('https://tse4.mm.bing.net/th?id=OIP.M3c2cc9aca94e4687c4ab4f94096116dao0&pid=15.1&P=0&w=228&h=172');

        $artist3 = new Artist();
        $artist3->setGenre('Rock');
        $artist3->setType('band');
        $artist3->setName('M');
        $artist3->setPicture('https://tse4.mm.bing.net/th?id=OIP.M3c2cc9aca94e4687c4ab4f94096116dao0&pid=15.1&P=0&w=228&h=172');

        $manager->persist($artist1);
        $manager->persist($artist2);
        $manager->persist($artist3);

        $this->addReference('artist1', $artist1);
        $this->addReference('artist2', $artist2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}