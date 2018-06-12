<?php
/**
 * Reports plugin for Craft CMS 3.x
 *
 * Internal Reporting
 *
 * @link      https://selvin.co
 * @copyright Copyright (c) 2018 Selvin Ortiz
 */

namespace kingdomadvisors\reports\widgets;

use kingdomadvisors\reports\Reports;
use kingdomadvisors\reports\assetbundles\reportswidgetwidget\ReportsWidgetWidgetAsset;

use Craft;
use craft\base\Widget;

/**
 * Reports Widget
 *
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class ReportsWidget extends Widget
{

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $message = 'Hello, world.';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('reports', 'ReportsWidget');
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        return Craft::getAlias("@kingdomadvisors/reports/assetbundles/reportswidgetwidget/dist/img/ReportsWidget-icon.svg");
    }

    /**
     * @inheritdoc
     */
    public static function maxColspan()
    {
        return null;
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge(
            $rules,
            [
                ['message', 'string'],
                ['message', 'default', 'value' => 'Hello, world.'],
            ]
        );
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate(
            'reports/_components/widgets/ReportsWidget_settings',
            [
                'widget' => $this
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getBodyHtml()
    {
        Craft::$app->getView()->registerAssetBundle(ReportsWidgetWidgetAsset::class);

        return Craft::$app->getView()->renderTemplate(
            'reports/_components/widgets/ReportsWidget_body',
            [
                'message' => $this->message
            ]
        );
    }
}
