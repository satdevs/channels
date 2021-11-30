<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property int $id
 * @property int|null $version_id
 * @property int|null $headstation_id
 * @property string|null $encoded
 * @property string|null $broadcast
 * @property int|null $packageGroup
 * @property int|null $packageorder
 * @property string $name
 * @property string|null $shortname
 * @property string|null $popular_name
 * @property string|null $external_name
 * @property string|null $comment
 * @property string|null $popular_comment_analog
 * @property string|null $popular_comment_digital
 * @property int|null $price
 * @property bool|null $visible
 * @property int|null $pos
 * @property int|null $programs_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Version $version
 * @property \App\Model\Entity\Headstation $headstation
 * @property \App\Model\Entity\PackagesProgramsAnalog[] $packages_programs_analogs
 * @property \App\Model\Entity\PackagesProgramsDigital[] $packages_programs_digitals
 */
class Package extends Entity
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
        'headstation_id' => true,
        'packagegroup_id' => true,
        'encoded' => true,
        'broadcast' => true,
        'packageGroup' => true,
        'packageorder' => true,
        'name' => true,
        'shortname' => true,
        'popular_name' => true,
        'external_name' => true,
        'comment' => true,
        'popular_comment_analog' => true,
        'popular_comment_digital' => true,
        'price' => true,
        'visible' => true,
        'pos' => true,
        'programs_count' => true,
        'created' => true,
        'modified' => true,
        'version' => true,
        'headstation' => true,
        'packages_programs_analog_count' => true,
        'packages_programs_digital_count' => true,
        'packages_programs_analogs' => true,
        'packages_programs_digitals' => true,
    ];
}
