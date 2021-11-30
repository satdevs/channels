<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AckeysTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AckeysTable Test Case
 */
class AckeysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AckeysTable
     */
    protected $Ackeys;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Ackeys',
        'app.Versions',
        'app.PackagesProgramsDigitals',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ackeys') ? [] : ['className' => AckeysTable::class];
        $this->Ackeys = $this->getTableLocator()->get('Ackeys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Ackeys);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AckeysTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AckeysTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
