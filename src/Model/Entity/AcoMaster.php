<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AcoMaster Entity
 *
 * @property int $id
 * @property string $aco_title
 * @property string $aco_description
 * @property int $parent_id
 * @property int $sort_order
 * @property int $menu_type
 * @property int $status
 * @property string $glyphicon
 * @property string $controller
 * @property string $action
 * @property int $type
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\ParentAcoMaster $parent_aco_master
 * @property \App\Model\Entity\ChildAcoMaster[] $child_aco_masters
 */
class AcoMaster extends Entity
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
        '*' => true,
        'id' => false
    ];
}
