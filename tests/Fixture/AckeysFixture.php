<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AckeysFixture
 */
class AckeysFixture extends TestFixture
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
                'value' => 'Lorem ipsum dolor ',
                'visible' => 1,
                'pos' => 1,
                'created' => '2021-10-29 06:06:18',
                'modified' => '2021-10-29 06:06:18',
            ],
        ];
        parent::init();
    }
}
