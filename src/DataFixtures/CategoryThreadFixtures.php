<?php

namespace App\DataFixtures;

use App\Entity\Thread;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryThreadFixtures extends AbstractFixtures
{

    public function load(ObjectManager $manager)
    {
        $threads = $manager->getRepository(Thread::class)->findAll();
        $categories = $manager->getRepository(Category::class)->findAll();

        foreach ($threads as $thread) {
            $randomCategories = $this->faker->randomElements($categories, mt_rand(1, 3));
            foreach ($randomCategories as $category) {
                $thread->addCategory($category);
            }
        }

        $manager->flush();
    }
}
