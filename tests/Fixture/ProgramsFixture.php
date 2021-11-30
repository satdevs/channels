<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProgramsFixture
 */
class ProgramsFixture extends TestFixture
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
                'feature_id' => 1,
                'language_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'short_name' => 'Lorem ip',
                'logo_file' => 'Lorem ipsum dolor sit amet',
                'logo_url' => 'Lorem ipsum dolor sit amet',
                'url' => 'Lorem ipsum dolor sit amet',
                'programs_url' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'new' => 1,
                'visible' => 1,
                'pos' => 1,
                'packages_count' => 1,
                'created' => '2021-10-28 13:20:45',
                'modified' => '2021-10-28 13:20:45',
            ],
        ];
        parent::init();
    }
}
