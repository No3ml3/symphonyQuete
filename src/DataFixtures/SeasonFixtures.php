<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        [
            'number' => 1,
            'description' => 'saison 1',
            'year' => 2002,
            'program' => 'program_punisher'
        ],[
            'number' => 2,
            'description' => 'saison 2',
            'year' => 2003,
            'program' => 'program_punisher'

        ],[
            'number' => 3,
            'description' => 'saison 3',
            'year' => 2004, 
            'program' => 'program_punisher'

        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $key => $seasons) {
            $season = new Season();
            $season->setNumber($seasons['number']);
            $season->setDescription($seasons['description']);
            $season->setYear($seasons['year']);
            $season->setProgram($this->getReference($seasons['program']));
            $manager->persist($season);
            $this->addReference('season_' . $seasons['number'], $season);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}