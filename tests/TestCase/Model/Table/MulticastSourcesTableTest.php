<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MulticastSourcesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MulticastSourcesTable Test Case
 */
class MulticastSourcesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MulticastSourcesTable
     */
    protected $MulticastSources;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.MulticastSources',
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
        $config = $this->getTableLocator()->exists('MulticastSources') ? [] : ['className' => MulticastSourcesTable::class];
        $this->MulticastSources = $this->getTableLocator()->get('MulticastSources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MulticastSources);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MulticastSourcesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MulticastSourcesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
