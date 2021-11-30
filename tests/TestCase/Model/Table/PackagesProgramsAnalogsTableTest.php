<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackagesProgramsAnalogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackagesProgramsAnalogsTable Test Case
 */
class PackagesProgramsAnalogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PackagesProgramsAnalogsTable
     */
    protected $PackagesProgramsAnalogs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PackagesProgramsAnalogs',
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
        $config = $this->getTableLocator()->exists('PackagesProgramsAnalogs') ? [] : ['className' => PackagesProgramsAnalogsTable::class];
        $this->PackagesProgramsAnalogs = $this->getTableLocator()->get('PackagesProgramsAnalogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PackagesProgramsAnalogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PackagesProgramsAnalogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PackagesProgramsAnalogsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
