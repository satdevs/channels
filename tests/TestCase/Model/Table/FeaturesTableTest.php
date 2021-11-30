<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeaturesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeaturesTable Test Case
 */
class FeaturesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FeaturesTable
     */
    protected $Features;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Features',
        'app.Programs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Features') ? [] : ['className' => FeaturesTable::class];
        $this->Features = $this->getTableLocator()->get('Features', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Features);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FeaturesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
