<?php

namespace App\DataFixtures;

use App\Entity\ThreadVote;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ThreadVoteFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            $ThreadVote = new ThreadVote();
            $ThreadVote->setUser($this->getReference('user_' . $this->faker->numberBetween(0,9)));
            $ThreadVote->setThread($this->getReference('thread_' . $this->faker->numberBetween(0,19)));
            $ThreadVote->setVote($this->faker->boolean());
            $manager->persist($ThreadVote);
        }

        $manager->flush();
    }

    public function getDependencies()
    {   
        return [
            UserFixtures::class,
            ThreadFixtures::class,
        ];
    }
}
