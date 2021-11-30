<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PackagesProgramsDigitalsFixture
 */
class PackagesProgramsDigitalsFixture extends TestFixture
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
                'package_id' => 1,
                'program_id' => 1,
                'multicast_source_id' => 1,
                'ackey_id' => 1,
                'packageorder' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'short_name' => 'Lorem ip',
                'lcn' => 1,
                'channel' => 'Lorem ipsum dolor ',
                'frequency' => 1.5,
                'qam' => 'Lorem ip',
                'sid' => 1,
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'public_comment' => 'Lorem ipsum dolor sit amet',
                'changed' => 'Lorem ipsum dolor sit amet',
                'to_delete' => 1,
                'visible' => 1,
                'pos' => 1,
                'created' => '2021-10-28 13:20:45',
                'modified' => '2021-10-28 13:20:45',
            ],
        ];
        parent::init();
    }
}
