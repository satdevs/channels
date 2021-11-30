<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrackingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrackingsTable Test Case
 */
class TrackingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TrackingsTable
     */
    protected $Trackings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Trackings',
        'app.Versions',
        'app.Olds',
        'app.News',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Trackings') ? [] : ['className' => TrackingsTable::class];
        $this->Trackings = $this->getTableLocator()->get('Trackings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Trackings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TrackingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TrackingsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
