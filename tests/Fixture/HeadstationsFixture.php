<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HeadstationsFixture
 */
class HeadstationsFixture extends TestFixture
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
                'place' => 'Lorem ipsum dolor sit amet',
                'last_sentence' => 'Lorem ipsum dolor sit amet',
                'last_digital_sentence' => 'Lorem ipsum dolor sit amet',
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'package_count' => 1,
                'city_count' => 1,
                'visible' => 1,
                'pos' => 1,
                'created' => '2021-10-28 13:20:44',
                'modified' => '2021-10-28 13:20:44',
            ],
        ];
        parent::init();
    }
}
