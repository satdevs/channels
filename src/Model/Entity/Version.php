<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Version Entity
 *
 * @property int $id
 * @property int $headstation_id
 * @property string $name
 * @property string|null $comment
 * @property bool|null $current
 * @property \Cake\I18n\FrozenDate|null $date_from
 * @property \Cake\I18n\FrozenDate|null $date_to
 * @property bool|null $visible
 * @property int|null $pos
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Headstation $headstation
 * @property \App\Model\Entity\Ackey[] $ackeys
 * @property \App\Model\Entity\MulticastSource[] $multicast_sources
 * @property \App\Model\Entity\Package[] $packages
 * @property \App\Model\Entity\PackagesProgramsAnalog[] $packages_programs_analogs
 * @property \App\Model\Entity\PackagesProgramsDigital[] $packages_programs_digitals
 * @property \App\Model\Entity\Program[] $programs
 */
class Version extends Entity
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
        'broadcast' => true,
        'name' => true,
        'comment' => true,
        'current' => true,
        'date_from' => true,
        'date_to' => true,
        'visible' => true,
        'print_image' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'headstation' => true,
        'ackeys' => true,
        'multicast_sources' => true,
        'packages' => true,
        'packages_programs_analogs' => true,
        'packages_programs_digitals' => true,
        'programs' => true,
    ];
}
