<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ackey Entity
 *
 * @property int $id
 * @property int $version_id
 * @property string $name
 * @property string $value
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Version $version
 * @property \App\Model\Entity\PackagesProgramsDigital[] $packages_programs_digitals
 */
class Ackey extends Entity
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
        'name' => true,
        'value' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'packages_programs_digitals' => true,
    ];
}
