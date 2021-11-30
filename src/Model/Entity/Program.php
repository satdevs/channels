<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Program Entity
 *
 * @property int $id
 * @property int $version_id
 * @property int|null $feature_id
 * @property int|null $language_id
 * @property string $name
 * @property string|null $short_name
 * @property string|null $logo_file
 * @property string|null $logo_url
 * @property string|null $url
 * @property string|null $programs_url
 * @property string|null $email
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $comment
 * @property bool|null $new
 * @property bool|null $visible
 * @property int|null $pos
 * @property int|null $packages_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Version $version
 * @property \App\Model\Entity\Feature $feature
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\PackagesProgramsAnalog[] $packages_programs_analogs
 * @property \App\Model\Entity\PackagesProgramsDigital[] $packages_programs_digitals
 */
class Program extends Entity
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
        'feature_id' => true,
        'language_id' => true,
        'multicast_source_id' => true,
        'name' => true,
        'short_name' => true,
        'logo_file' => true,
        'logo_url' => true,
        'url' => true,
        'programs_url' => true,
        'email' => true,
        'address' => true,
        'phone' => true,
        'comment' => true,
        'new' => true,
        'visible' => true,
        'pos' => true,
        'packages_count' => true,
        'created' => true,
        'modified' => true,
        'version' => true,
        'feature' => true,
        'language' => true,
        'packages_programs_analog_count' => true,
        'packages_programs_digital_count' => true,
        'packages_programs_analogs' => true,
        'packages_programs_digitals' => true,
    ];
}
