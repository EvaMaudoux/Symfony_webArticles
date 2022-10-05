<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private array $categories = ['PHP 8', 'Symfony', 'Laravel', 'Security', 'DataBase',
        'JavaScript','Front End'];

    public function load(ObjectManager $manager): void // object manager sert a manipuler la base de donnée voir les méthodes injectée en dépendance
    {

        foreach($this->categories as $category) {
            $cat = new Category();  // instanciation d'un objet de la classe Category
            $cat->setName($category); // setname de l'entité Catégorie
            $manager->persist($cat); // on persist la $cat
        }
        $manager->flush();
    }
}