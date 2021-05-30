<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\Products;
use App\Entity\Seller;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface as UserPasswordEncoderInterfaceAlias;

class AppFixtures extends Fixture
{
    protected Generator $faker;

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
        $this->loadAdmins($manager);
//        $this->loadContacts($manager);
//        $this->loadSellers($manager);
//        $this->loadCustomer($manager);
//        $this->loadtCategories($manager);
//        $this->loadProducts($manager);

    }

    private function loadAdmins(ObjectManager $manager)
    {

        $admin = new Admin();
        $admin->setUsername("super");
        $admin->setRoles(["ROLE_SUPER_ADMIN"]);
        $admin->setFullName("Super User");
        $admin->setEmail("faez.taghavi@gmail.com");
        $admin->setPassword(
            $this->passwordEncoder->encodePassword(
                $admin,
                "root"
            )
        );

        $admin2 = new Admin();
        $admin2->setUsername("admin");
        $admin2->setFullName("dummy admin");
        $admin2->setEmail("admin@gmail.com");
        $admin2->setRoles(["ROLE_ADMIN"]);
        $admin2->setPassword(
            $this->passwordEncoder->encodePassword(
                $admin2,
                "1234"
            )
        );

        $manager->persist($admin);
        $manager->persist($admin2);

        $manager->flush();
    }

    private function loadContacts(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $contact = new Contact();
            $contact->setName($this->faker->name);
            $contact->setEmail($this->faker->email);
            $contact->setSubject($this->faker->realText(20));
            $contact->setMessage($this->faker->realText(500));

            $manager->persist($contact);
        }

        $manager->flush();
    }

    private function loadSellers(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $seller = new Seller();
            $seller->setUsername($this->faker->userName);
            $seller->setFirstName($this->faker->firstName);
            $seller->setLastName($this->faker->lastName);
            $seller->setEmail($this->faker->email);
            $seller->setPhoneNo($this->faker->phoneNumber);
            $seller->setAddress($this->faker->address);
            $seller->setCountry($this->faker->country);
            $seller->setIsVerified($this->faker->boolean(50));
            $seller->setImage("https://picsum.photos/500/300?random=$i");
            $seller->setCreatedAt($this->faker->dateTimeThisDecade);
            $seller->setUpdatedAt($this->faker->dateTimeThisDecade);

            $seller->setPassword(
                $this->passwordEncoder->encodePassword(
                    $seller,
                    $this->faker->password
                )
            );

            $this->setReference("seller$i", $seller);

            $manager->persist($seller);
        }

        $manager->flush();
    }

    private function loadCustomer(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $customer = new Customer();
            $customer->setUsername($this->faker->userName);
            $customer->setFirstName($this->faker->firstName);
            $customer->setLastName($this->faker->lastName);
            $customer->setEmail($this->faker->email);
            $customer->setPhoneNo($this->faker->phoneNumber);
            $customer->setAddress($this->faker->address);
            $customer->setCountry($this->faker->country);
            $customer->setIsVerified($this->faker->boolean(50));
            $customer->setImage("https://picsum.photos/500/300?random=$i");
            $customer->setCreatedAt($this->faker->dateTimeThisDecade);
            $customer->setUpdatedAt($this->faker->dateTimeThisDecade);

            $customer->setPassword(
                $this->passwordEncoder->encodePassword(
                    $customer,
                    $this->faker->password
                )
            );


            $manager->persist($customer);
        }

        $manager->flush();
    }

    private function loadtCategories(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($this->faker->word);
            $category->setDescription($this->faker->realText(50));
            $category->setIsLux($this->faker->boolean(50));
            $category->setThumbnail("https://picsum.photos/200/200?random=$i");

            $this->setReference("cat$i", $category);
            $manager->persist($category);

        }

        $manager->flush();
    }

    private function loadProducts(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setFullName("product$i");
            $product->setBrand($this->faker->firstNameMale);
            $product->setModel($this->faker->randomKey());
            $product->setQuantity($this->faker->randomDigitNotNull);
            $product->setColor($this->faker->colorName);
            $product->setDicount(round($this->faker->randomFloat()));

            $product->setBriefDescription($this->faker->realText(100));
            $product->setDescription($this->faker->realText(1000));
            $product->setPrice(round($this->faker->randomFloat()));
            $product->setWeight($this->faker->randomDigitNotNull);
            $product->setCreatedAt($this->faker->dateTimeThisDecade);
            $product->setUpdatedAt($this->faker->dateTimeThisDecade);

            $product->setThumbnail("https://picsum.photos/200/200?random=$i");
            $product->setImage("https://picsum.photos/500/300?random=$i");

            $product->addCategory($this->getReference("cat$i"));
            $product->setSeller($this->getReference("seller$i"));

            $manager->persist($product);
        }

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($this->faker->userName);
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
}
