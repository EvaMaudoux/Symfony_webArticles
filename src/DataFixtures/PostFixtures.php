<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(); // Instanciation du générateur Faker
        $categories = $manager->getRepository(Category::class)->findAll(); // utilisation de la classe du manager getrepository qui va permettre de récup les données de l'entitée et le findall . va chercher toutes les infos et stocke les dans $categories
        $countCat = count($categories);
        $manager->flush();

        for($i=1; $i <= 35 ; $i++)
        {
            $post = new Post();
            $post->setTitle($faker->words($faker->numberBetween(3,5),true))// générer un titre de 3 à 5 mots avec faker
                ->setContent($faker->paragraphs(3,true))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setImage($i.'.png')
                ->setIsPublished($faker->boolean(90)) // 90% des articles sont published
                ->setCategory($categories [$faker->numberBetween(0,$countCat -1)]); // nombre aléatoire entre 0 et le nombre d"élément du tab -1 pour générer le numéro du tableau
            $manager->persist($post);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [CategoryFixtures::class,
        ]; // on indique que CategoryFixtures doit charger en prems
    }
}

