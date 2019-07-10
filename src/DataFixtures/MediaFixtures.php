<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Media;

class MediaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $media = new Media();
            $media->setMediaName("Medium_$i");
            $manager->persist($media);
            $manager->flush();
        }
    }
}
