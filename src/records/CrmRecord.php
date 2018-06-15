<?php
namespace kingdomadvisors\reports\records;

use yii\db\ActiveRecord;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class CrmRecord extends ActiveRecord
{
    public static function getDb()
    {
        return \Craft::$app->get('kdb');
    }
}
