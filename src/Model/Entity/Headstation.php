<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Headstation Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $place
 * @property string|null $last_sentence
 * @property string|null $last_digital_sentence
 * @property string|null $comment
 * @property int|null $package_count
 * @property int|null $city_count
 * @property bool|null $visible
 * @property int|null $pos
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\City[] $cities
 * @property \App\Model\Entity\Package[] $packages
 * @property \App\Model\Entity\Version[] $versions
 */
class Headstation extends Entity
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
        'place' => true,
        'last_sentence' => true,
        'last_digital_sentence' => true,
        'comment' => true,
        'package_count' => true,
        'city_count' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'cities' => true,
        'packages' => true,
        'versions' => true,
    ];
}
