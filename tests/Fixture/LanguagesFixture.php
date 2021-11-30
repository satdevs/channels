<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LanguagesFixture
 */
class LanguagesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'program_count' => 1,
                'created' => '2021-10-28 13:20:44',
                'modified' => '2021-10-28 13:20:44',
            ],
        ];
        parent::init();
    }
}
