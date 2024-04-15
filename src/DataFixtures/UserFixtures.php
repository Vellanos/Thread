<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixtures
{
    public function load(ObjectManager $manager)
    {
        $originalPassword = '12345678';
        
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->unique()->email());
            $user->setPseudo($this->faker->userName());
            $user->setPassword($this->passwordHasher->hashPassword($user, $originalPassword));
            $user->setCreated($this->faker->dateTimeBetween('-1 year', 'now'));
            $user->setEdited($this->faker->dateTimeBetween($user->getCreated(), 'now'));
            $manager->persist($user);

            $this->setReference('user_' . $i, $user);
        }
        $manager->flush();
    }
}
