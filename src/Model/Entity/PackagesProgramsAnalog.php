<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PackagesProgramsAnalog Entity
 *
 * @property int $id
 * @property int|null $version_id
 * @property int|null $package_id
 * @property int|null $program_id
 * @property int|null $band_id
 * @property int|null $packageorder
 * @property string|null $name
 * @property int|null $lcn
 * @property string|null $channel
 * @property string|null $frequency
 * @property string|null $comment
 * @property string|null $public_comment
 * @property string|null $changed
 * @property bool|null $to_delete
 * @property bool|null $visible
 * @property int|null $pos
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Version $version
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Band $band
 */
class PackagesProgramsAnalog extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'version_id' => true,
        'package_id' => true,
        'program_id' => true,
        'band_id' => true,
        'packagegroup_id' => true,
        'packageorder' => true,
        'name' => true,
        'lcn' => true,
        'channel' => true,
        'frequency' => true,
        'comment' => true,
        'public_comment' => true,
        'changed' => true,
        'to_delete' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'version' => true,
        'package' => true,
        'program' => true,
        'band' => true,
    ];
}
