<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BandsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BandsTable Test Case
 */
class BandsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BandsTable
     */
    protected $Bands;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Bands',
        'app.PackagesProgramsAnalogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Bands') ? [] : ['className' => BandsTable::class];
        $this->Bands = $this->getTableLocator()->get('Bands', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Bands);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BandsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
