<?php

namespace HZ\Wonja237Bundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use HZ\Wonja237Bundle\Entity\Category;


class LoadCategory extends AbstractFixture implements orderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
  $category = new Category();
  $category->setName("Couper Decale");
  $manager->persist($category);

  $category1 = new category();
  $category1->setName("Love");
  $manager->persist($category1);

  $category2 = new category();
  $category2->setName("RAP");
  $manager->persist($category2);


  $manager->flush();
  $this->addReference('category',$category);
  $this->addReference('category1',$category1);
  $this->addReference('category2',$category2);


}
public function getOrder(){
  return 3;
}

}
