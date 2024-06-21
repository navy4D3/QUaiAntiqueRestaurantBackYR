<?php
namespace App\DataFixtures;
use App\Entity\Restaurant;
use App\Service\Utils;
use App\Entity\Picture;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
class PictureFixtures extends Fixture implements DependentFixtureInterface
{
    /** @throws Exception */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            /** @var Restaurant $restaurant */
            $restaurant = $this->getReference("restaurant" . random_int(1, RestaurantFixtures::RESTAURANT_NB_TUPLES));
            $title = "Article n°$i";
            $picture = (new Picture())
                ->setTitle($title)
                ->setSlug("slug")
                ->setRestaurant($restaurant)
                ->setCreatedAt(new DateTimeImmutable());
            $manager->persist($picture);
        }
        $manager->flush();
    }
    public function getDependencies(): array //obligé par implements DependentFictureInterfaace et dit que les Pictures dépend des restaurants (i.e PicturesFixtures depend de RestaurantFixture)
    {
        return [RestaurantFixtures::class];
    }
}