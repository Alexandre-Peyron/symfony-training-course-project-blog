<?php
namespace Admin\BlogBundle\DataFixtures\ORM;

use Admin\BlogBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    /**
     * Load fixtures Category
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $cat1 = new Category();
        $cat1->setName('Développement');
        $cat1->setDescription('Catégorie sur le développement web');
        $manager->persist($cat1);

        $this->setReference('cat-dev', $cat1);

        $cat2 = new Category();
        $cat2->setName('Langue');
        $cat2->setDescription('Catégorie sur les langues vivantes');
        $manager->persist($cat2);

        $cat3 = new Category();
        $cat3->setName('Développement personnel');
        $cat3->setDescription('Catégorie sur le développement personnel');
        $manager->persist($cat3);

        $manager->flush();
    }
}
