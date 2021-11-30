<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackagesProgramsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackagesProgramsTable Test Case
 */
class PackagesProgramsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PackagesProgramsTable
     */
    protected $PackagesPrograms;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PackagesPrograms',
        'app.Versions',
        'app.Packages',
        'app.Programs',
        'app.Bands',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PackagesPrograms') ? [] : ['className' => PackagesProgramsTable::class];
        $this->PackagesPrograms = $this->getTableLocator()->get('PackagesPrograms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PackagesPrograms);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PackagesProgramsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PackagesProgramsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
