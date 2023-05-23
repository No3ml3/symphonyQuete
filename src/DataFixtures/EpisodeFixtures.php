<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'episode un',
            'number' => 1,
            'synopsis' => 'blabla voila',
            'season' => 'season_1'
        ],[
            'title' => 'episode deux',
            'number' => 2,
            'synopsis' => 'blabla voila',
            'season' => 'season_1'

        ],[
            'title' => 'episode trois',
            'number' => 3,
            'synopsis' => 'blabla voila',
            'season' => 'season_1'

        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodes) {
            $episode = new Episode();
            $episode->setTitle($episodes['title']);
            $episode->setNumber($episodes['number']);
            $episode->setSynopsis($episodes['synopsis']);
            $episode->setSeason($this->getReference($episodes['season']));
            $manager->persist($episode);
            $this->addReference('episode_' . $key, $episode);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }

}