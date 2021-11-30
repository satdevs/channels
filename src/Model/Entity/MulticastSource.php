<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MulticastSource Entity
 *
 * @property int $id
 * @property int $version_id
 * @property string $name
 * @property string|null $comment
 * @property string|null $dest_ip
 * @property string|null $src_ip
 * @property string|null $port
 * @property string|null $interface
 * @property string|null $provider
 * @property int|null $packages_programs_digital_count
 * @property bool|null $visible
 * @property int|null $pos
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Version $version
 * @property \App\Model\Entity\PackagesProgramsDigital[] $packages_programs_digitals
 */
class MulticastSource extends Entity
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
        'name' => true,
        'comment' => true,
        'src_ip' => true,
        'dest_ip' => true,
        'port' => true,
        'interface' => true,
        'provider' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'version' => true,
        'packages_programs_digitals' => true,
    ];
}
