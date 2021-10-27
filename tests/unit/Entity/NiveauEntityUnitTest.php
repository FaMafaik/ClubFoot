<?php

namespace Tests\Unit\Entity;

use App\Entity\Niveau;
use PHPUnit\Framework\TestCase;

class NiveauEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\Niveau $niveau
         */
        $niveau = new Niveau();

        $niveau->setLibelle('Niveau 1');

        $this->assertTrue($niveau->getLibelle() === 'Niveau 1');
    }

    /**
     * @return void
     */
    public function testIsFalse(): void
    {
        /**
         * @var \App\Entity\Niveau $niveau
         */
        $niveau = new Niveau();
        $niveau->setLibelle('niveau');

        $this->assertFalse($niveau->getLibelle() === 'false');
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\Niveau $niveau
         */
        $niveau = new Niveau();

        $this->assertEmpty($niveau->getLibelle());
        $this->assertEmpty($niveau->getId());
    }
}
