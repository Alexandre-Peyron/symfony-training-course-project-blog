<?php
namespace Admin\BlogBundle\DataFixtures\ORM;

use Admin\BlogBundle\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    /**
     * Load Fixtures Article
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle('Mon premier article');
        $article->setHat('Ici je vous parle de mon premier article');
        $article->setContent('<p>Ceci est le contenu de mon premier article</p>');
        $article->setCategory($this->getReference('cat-dev'));
        $article->addTag($this->getReference('tag-javascript'));
        $article->addTag($this->getReference('tag-php'));

        $manager->persist($article);

        $article2 = new Article();
        $article2->setTitle('Mon Deuxième article');
        $article2->setHat('En voici un différent');
        $article2->setContent('<p>Un article avec plein de contenu diff&eacute;rents</p>

<p><s>ici un barr&eacute;</s></p>

<p style="text-align:center">La un centr&eacute;</p>

<p style="text-align:right"><strong>Du gras &agrave; droite</strong></p>');
        $article2->setCategory($this->getReference('cat-dev'));
        $article2->addTag($this->getReference('tag-symfony'));
        $article2->addTag($this->getReference('tag-php'));

        $manager->persist($article2);

        $manager->flush();
    }

    /**
     * Set fixtures dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
            TagFixtures::class
        );
    }
}
