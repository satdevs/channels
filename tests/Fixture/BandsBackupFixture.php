<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BandsBackupFixture
 */
class BandsBackupFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'bands_backup';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'row' => 1,
                'id' => 'Lore',
                'name' => 'Lorem ',
                'video_frequency' => 1.5,
                'audio_frequency' => 1.5,
                'visible' => 1,
                'pos' => 1,
                'packages_program_count' => 1,
                'modified' => '2021-10-26 11:30:14',
                'created' => '2021-10-26 11:30:14',
            ],
        ];
        parent::init();
    }
}
