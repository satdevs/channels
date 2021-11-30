<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BandsBackupTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BandsBackupTable Test Case
 */
class BandsBackupTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BandsBackupTable
     */
    protected $BandsBackup;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BandsBackup',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BandsBackup') ? [] : ['className' => BandsBackupTable::class];
        $this->BandsBackup = $this->getTableLocator()->get('BandsBackup', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BandsBackup);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BandsBackupTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
