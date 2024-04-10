<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {
        $catData = [
            "HTML",
            "CSS",
            "JavaScript",
            "PHP",
            "Python",
            "Ruby",
            "Java",
            "C#"
        ];
        
        for ($i = 0; $i < 8; $i++) {
            $category = new Category();
            $category->setTitle($catData[$i]);
            $category->setDescription($this->faker->words($this->faker->numberBetween(5,10), true));
            $category->setCreated($this->faker->dateTimeBetween('-1 year', 'now'));
            $category->setEdited($this->faker->dateTimeBetween($category->getCreated(), 'now'));
            $manager->persist($category);

        }
        

        $manager->flush();
    }

}
