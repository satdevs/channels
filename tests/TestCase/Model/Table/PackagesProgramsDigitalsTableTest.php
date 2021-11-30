<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackagesProgramsDigitalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackagesProgramsDigitalsTable Test Case
 */
class PackagesProgramsDigitalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PackagesProgramsDigitalsTable
     */
    protected $PackagesProgramsDigitals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PackagesProgramsDigitals',
        'app.Versions',
        'app.Packages',
        'app.Programs',
        'app.MulticastSources',
        'app.Ackeys',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PackagesProgramsDigitals') ? [] : ['className' => PackagesProgramsDigitalsTable::class];
        $this->PackagesProgramsDigitals = $this->getTableLocator()->get('PackagesProgramsDigitals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PackagesProgramsDigitals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PackagesProgramsDigitalsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PackagesProgramsDigitalsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
