<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organisation Entity.
 */
class Gyms extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'gymName' => true,
        'gymCity' => true,
        'gymState' => true,
        'gymZip' => true,
        'gymAddress' => true,
        'gymPhone' => true,
        'gymEmail' => true,
        'is_active' => true
    ];
}
