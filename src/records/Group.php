<?php
namespace kingdomadvisors\reports\records;

use craft\db\ActiveRecord;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class Group extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%reports_groups}}';
    }
}
