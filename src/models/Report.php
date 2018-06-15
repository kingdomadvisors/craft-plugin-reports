<?php
namespace kingdomadvisors\reports\models;

use craft\base\Model;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class Report extends Model
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $siteId;

    /**
     * @var int
     */
    public $groupId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $handle;

    /**
     * @var string
     */
    public $dataSource;

    /**
     * @var string
     */
    public $description;

    /**
     * @var array
     */
    public $settings;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name, handle, dataSource'], 'string', 'required'],
        ];
    }
}
