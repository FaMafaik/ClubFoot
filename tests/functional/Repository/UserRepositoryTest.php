<?php

namespace Tests\Functional\Repository;

use App\DataFixtures\UsersFixtures;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var mixed $databaseTool
     */
    protected $databaseTool;


    public function setUp(): void
    {

        parent::setUp();
        self::bootKernel();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }



    public function testCount(): void
    {
        $this->databaseTool->loadFixtures([
            UsersFixtures::class
        ]);

        /**
         * @var mixed $users
         */
        $users = self::getContainer()->get(UtilisateurRepository::class)->count([]);
        $this->assertEquals(2, $users);
    }
}
