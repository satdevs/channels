<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Band Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $band
 * @property string|null $video_frequency
 * @property string|null $audio_frequency
 * @property bool|null $visible
 * @property int|null $pos
 * @property int|null $packages_programs_count
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\PackagesProgramsAnalog[] $packages_programs_analogs
 */
class Band extends Entity
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
        'band' => true,
        'type' => true,
        'frequency' => true,
        'bandwidth' => true,
        'audio_frequency' => true,
        'visible' => true,
        'pos' => true,
        'packages_programs_analog_count' => true,
        'modified' => true,
        'created' => true,
        'packages_programs_analogs' => true,
    ];
	
	// https://book.cakephp.org/4/en/orm/entities.html#creating-virtual-fields
    protected function _getFullName()
    {
        //return __('Band') . ': ' . $this->band . ', '. __('Type') . ': ' . $this->type . ', '. __('Freq') . ': ' . $this->frequency . ' Mhz, ' . __('Bandwidth') . ': ' . $this->bandwidth . ', ' . __('Audio freq') . ': ' . $this->audio_frequency . ' Mhz';
        return $this->band . ' • ' . $this->type . ' • Freq.:' . $this->frequency . ' Mhz • Sávszél.: ' . $this->bandwidth . ' Mhz • Audió: ' . $this->audio_frequency . ' Mhz';
    }	
	
	
}
