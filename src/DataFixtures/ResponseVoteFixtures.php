<?php

namespace App\DataFixtures;

use App\Entity\ResponseVote;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ResponseVoteFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            $ResponseVote = new ResponseVote();
            $ResponseVote->setUser($this->getReference('user_' . $this->faker->numberBetween(0,9)));
            $ResponseVote->setResponse($this->getReference('response_' . $this->faker->numberBetween(0,49)));
            $ResponseVote->setVote($this->faker->boolean());
            $manager->persist($ResponseVote);
        }

        $manager->flush();
    }

    public function getDependencies()
    {   
        return [
            UserFixtures::class,
            ResponseFixtures::class,
        ];
    }
}
