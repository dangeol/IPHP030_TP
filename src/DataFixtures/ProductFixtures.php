<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Tag;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1->setName("Product_1");
        $product1->setPrice(24.99);
        $category = $manager
            ->getRepository(Category::class)
            ->findOneBy(array('categoryName' => 'Category_1'));
        $product1->setCategory($category);
        $product1->setLikes(3);
        $manager->persist($product1);
        $manager->flush();

        $product2 = new Product();
        $product2->setName("Product_2");
        $product2->setPrice(100.00);
        $category = $manager
            ->getRepository(Category::class)
            ->findOneBy(array('categoryName' => 'Category_3'));
        $product2->setCategory($category);
        $tag1 = $manager
            ->getRepository(Tag::class)
            ->findOneBy(array('tagName' => 'Tag_1'));
        $tag2 = $manager
            ->getRepository(Tag::class)
            ->findOneBy(array('tagName' => 'Tag_2'));
        $tag3 = $manager
            ->getRepository(Tag::class)
            ->findOneBy(array('tagName' => 'Tag_3'));
        //$product2->addTag($tag1);
        //$product2->addTag($tag2);
        //$product2->addTag($tag3);
        $product2->setLikes(4);
        $manager->persist($product2);
        $manager->flush();

        $product3 = new Product();
        $product3->setName("Product_3");
        $product3->setPrice(200.00);

        $product4 = new Product();
        $product4->setName("Product_4");
        $product4->setPrice(5.90);

        $product5 = new Product();
        $product5->setName("Product_5");
        $product5->setPrice(99.00);
    }

    public function getDependencies()
    {
        return array(
            TagFixtures::class,
        );
    }
}
