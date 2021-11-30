<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Language Entity
 *
 * @property int $id
 * @property string $name
 * @property bool|null $visible
 * @property int|null $pos
 * @property int|null $program_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Program[] $programs
 */
class Language extends Entity
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
        'visible' => true,
        'pos' => true,
        'program_count' => true,
        'created' => true,
        'modified' => true,
        'programs' => true,
    ];
}
