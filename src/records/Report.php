<?php
namespace kingdomadvisors\reports\records;

use yii\db\ActiveQueryInterface;

use craft\base\Element;
use craft\db\ActiveRecord;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 *
 * @property int       $id
 * @property int       $siteId
 * @property string    $name
 * @property string    $handle
 * @property int       $groupId
 * @property string    $dataSource
 * @property string    $description
 * @property array     $settings
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string    $uid
 */
class Report extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%reports_reports}}';
    }

    public function getElement(): ActiveQueryInterface
    {
        return $this->hasOne(Element::class, ['id' => 'id']);
    }
}
