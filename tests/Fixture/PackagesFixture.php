<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PackagesFixture
 */
class PackagesFixture extends TestFixture
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
                'headstation_id' => 1,
                'encoded' => 'Lorem ipsum dolor ',
                'broadcast' => 'Lorem ip',
                'packageGroup' => 1,
                'packageorder' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'shortname' => 'Lorem ipsum dolor sit amet',
                'popular_name' => 'Lorem ipsum dolor sit amet',
                'external_name' => 'Lorem ipsum dolor sit amet',
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'popular_comment_analog' => 'Lorem ipsum dolor sit amet',
                'popular_comment_digital' => 'Lorem ipsum dolor sit amet',
                'price' => 1,
                'visible' => 1,
                'pos' => 1,
                'programs_count' => 1,
                'created' => '2021-10-28 13:20:45',
                'modified' => '2021-10-28 13:20:45',
            ],
        ];
        parent::init();
    }
}
