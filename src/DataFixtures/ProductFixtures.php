<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Tag;
use App\Entity\Media;

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
        $medium = $manager
            ->getRepository(Media::class)
            ->findOneBy(array('mediaName' => 'Medium_3'));
        $product1->setMedia($medium);
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
        $medium = $manager
            ->getRepository(Media::class)
            ->findOneBy(array('mediaName' => 'Medium_1'));
        $product2->setMedia($medium);
        $product2->setLikes(4);
        $manager->persist($product2);
        $manager->flush();

        $product3 = new Product();
        $product3->setName("Product_3");
        $product3->setPrice(200.00);
        $category = $manager
            ->getRepository(Category::class)
            ->findOneBy(array('categoryName' => 'Category_5'));
        $product3->setCategory($category);
        $manager->persist($product3);
        $manager->flush();

        $product4 = new Product();
        $product4->setName("Product_4");
        $product4->setPrice(5.90);
        $category = $manager
            ->getRepository(Category::class)
            ->findOneBy(array('categoryName' => 'Category_4'));
        $product4->setCategory($category);
        $manager->persist($product4);
        $manager->flush();

        $product5 = new Product();
        $product5->setName("Product_5");
        $product5->setPrice(99.00);
        $category = $manager
            ->getRepository(Category::class)
            ->findOneBy(array('categoryName' => 'Category_1'));
        $product5->setCategory($category);
        $manager->persist($product5);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            MediaFixtures::class,
            TagFixtures::class
        );
    }
}
