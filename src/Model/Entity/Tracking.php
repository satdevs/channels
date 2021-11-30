<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tracking Entity
 *
 * @property int $id
 * @property int $version_id
 * @property string $name
 * @property int $old_id
 * @property int $new_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Version $version
 * @property \App\Model\Entity\Old $old
 * @property \App\Model\Entity\News $news
 */
class Tracking extends Entity
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
        'old_id' => true,
        'new_id' => true,
        'created' => true,
        'version' => true,
        'old' => true,
        'news' => true,
    ];
}
