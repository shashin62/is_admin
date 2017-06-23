<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $address
 * @property string $password
 * @property string $firstname
 * @property string $formername
 * @property string $lastname
 * @property string $headline
 * @property int $industry
 * @property string $summary
 * @property string $photo
 * @property int $group_id
 * @property int $is_deleted
 * @property int $is_admin_panel
 * @property string $forgot_token
 * @property string $access_token
 * @property \Cake\I18n\FrozenTime $last_login
 * @property int $status
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Group $group
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
