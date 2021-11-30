<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TrackingsFixture
 */
class TrackingsFixture extends TestFixture
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
                'version_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'old_id' => 1,
                'new_id' => 1,
                'created' => '2021-11-10 06:44:42',
            ],
        ];
        parent::init();
    }
}
