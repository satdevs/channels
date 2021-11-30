<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MulticastSourcesFixture
 */
class MulticastSourcesFixture extends TestFixture
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
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'dest_ip' => 'Lorem ipsum d',
                'src_ip' => 'Lorem ipsum d',
                'port' => 'Lorem ipsum dolor sit amet',
                'interface' => 'Lorem ipsum dolor sit amet',
                'provider' => 'Lorem ip',
                'packages_programs_digital_count' => 1,
                'visible' => 1,
                'pos' => 1,
                'created' => '2021-10-28 13:20:44',
                'modified' => '2021-10-28 13:20:44',
            ],
        ];
        parent::init();
    }
}
