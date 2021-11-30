<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackagegroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackagegroupsTable Test Case
 */
class PackagegroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PackagegroupsTable
     */
    protected $Packagegroups;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Packagegroups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Packagegroups') ? [] : ['className' => PackagegroupsTable::class];
        $this->Packagegroups = $this->getTableLocator()->get('Packagegroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Packagegroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PackagegroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
