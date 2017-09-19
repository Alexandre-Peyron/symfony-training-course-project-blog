<?php
namespace Admin\BlogBundle\DataFixtures\ORM;

use Admin\BlogBundle\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    /**
     * Load fixtures Tag
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag();
        $tag1->setName('Javascript');
        $tag1->setDescription('Tag javascript');
        $manager->persist($tag1);

        $this->addReference('tag-javascript', $tag1);

        $tag2 = new Tag();
        $tag2->setName('PHP');
        $tag2->setDescription('Tag php');
        $manager->persist($tag2);

        $this->addReference('tag-php', $tag2);

        $tag3 = new Tag();
        $tag3->setName('Symfony');
        $tag3->setDescription('Tag symfony');
        $manager->persist($tag3);

        $this->addReference('tag-symfony', $tag3);

        $tag4 = new Tag();
        $tag4->setName('React');
        $tag4->setDescription('Tag react');
        $manager->persist($tag4);

        $tag5 = new Tag();
        $tag5->setName('Angular');
        $tag5->setDescription('Tag Angular');
        $manager->persist($tag5);

        $manager->flush();
    }
}
