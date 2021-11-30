<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BandsFixture
 */
class BandsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ',
                'band' => 'Lore',
                'video_frequency' => 1.5,
                'audio_frequency' => 1.5,
                'visible' => 1,
                'pos' => 1,
                'packages_programs_count' => 1,
                'modified' => '2021-10-28 13:20:43',
                'created' => '2021-10-28 13:20:43',
            ],
        ];
        parent::init();
    }
}
