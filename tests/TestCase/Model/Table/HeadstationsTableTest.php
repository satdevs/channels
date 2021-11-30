<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HeadstationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HeadstationsTable Test Case
 */
class HeadstationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HeadstationsTable
     */
    protected $Headstations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Headstations',
        'app.Cities',
        'app.Packages',
        'app.Versions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Headstations') ? [] : ['className' => HeadstationsTable::class];
        $this->Headstations = $this->getTableLocator()->get('Headstations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Headstations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HeadstationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
