<?php
namespace kingdomadvisors\reports\records;

use craft\db\ActiveRecord;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 *
 * @property int       $id
 * @property int       $siteId
 * @property string    $name
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string    $uid;
 */
class Group extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%reports_groups}}';
    }
}
