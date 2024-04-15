<?php

namespace App\DataFixtures;

use App\Entity\Response;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ResponseFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $response = new Response();
            $response->setMain($this->faker->words($this->faker->numberBetween(10,30), true));
            $response->setCreated($this->faker->dateTimeBetween('-1 year', 'now'));
            $response->setEdited($this->faker->dateTimeBetween($response->getCreated(), 'now'));
            $response->setUser($this->getReference('user_' . $this->faker->numberBetween(0,9)));
            $response->setThread($this->getReference('thread_' . $this->faker->numberBetween(0,19)));
            $manager->persist($response);

            $this->setReference('response_' . $i, $response);
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
