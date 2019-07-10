<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Comment;
use App\Entity\Product;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1->setCommentText("This is the best product ever");
        $product = $manager
            ->getRepository(Product::class)
            ->findOneBy(array('Name' => 'Product_1'));
        $comment1->setProduct($product);
        $manager->persist($comment1);
        $manager->flush();

        $comment2 = new Comment();
        $comment2->setCommentText("I regret the purchase of this product");
        $product = $manager
            ->getRepository(Product::class)
            ->findOneBy(array('Name' => 'Product_3'));
        $comment1->setProduct($product);
        $manager->persist($comment2);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProductFixtures::class,
        );
    }
}
