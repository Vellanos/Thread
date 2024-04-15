<?php

namespace App\DataFixtures;

use App\Entity\Thread;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ThreadFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $thread = new Thread();
            $thread->setTitle($this->faker->word($this->faker->numberBetween(1,5)));
            $thread->setDescription($this->faker->words($this->faker->numberBetween(5,10), true));
            $thread->setMain($this->faker->words($this->faker->numberBetween(10,30), true));
            $thread->setStatus('open');
            $thread->setCreated($this->faker->dateTimeBetween('-1 year', 'now'));
            $thread->setEdited($this->faker->dateTimeBetween($thread->getCreated(), 'now'));
            $thread->setIdUser($this->getReference('user_' . $this->faker->numberBetween(0,9)));
            $manager->persist($thread);

            $this->setReference('thread_' . $i, $thread);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
