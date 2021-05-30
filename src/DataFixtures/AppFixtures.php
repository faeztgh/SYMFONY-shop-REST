<?php

namespace App\DataFixtures;

use App\Entity\Products;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface as UserPasswordEncoderInterfaceAlias;

class AppFixtures extends Fixture
{
    protected $faker;

    /**
     * @var UserPasswordEncoderInterfaceAlias
     */
    private UserPasswordEncoderInterfaceAlias $passwordEncoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterfaceAlias $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterfaceAlias $passwordEncoder)
    {
        $this->faker = Factory::create();
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadProducts($manager);

    }

    private function loadUsers(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($this->faker->userName);
            $user->setFullName($this->faker->name);
            $user->setEmail($this->faker->email);

            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $this->faker->password
                )
            );

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function loadProducts(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Products();
            $product->setName("product$i");
            $product->setBriefDescription($this->faker->realText(100));
            $product->setDescription($this->faker->realText(1000));
            $product->setPrice(round($this->faker->randomFloat()));
            $product->setWeight($this->faker->randomDigitNotNull);
            $product->setCreateDate($this->faker->dateTimeThisDecade);

            $product->setThumbnail("https://picsum.photos/200/200?random=$i");
            $product->setImage("https://picsum.photos/500/300?random=$i");

            $manager->persist($product);
        }

        $manager->flush();
    }
}
