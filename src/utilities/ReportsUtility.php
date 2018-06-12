<?php
/**
 * Reports plugin for Craft CMS 3.x
 *
 * Internal Reporting
 *
 * @link      https://selvin.co
 * @copyright Copyright (c) 2018 Selvin Ortiz
 */

namespace kingdomadvisors\reports\utilities;

use kingdomadvisors\reports\Reports;
use kingdomadvisors\reports\assetbundles\reportsutilityutility\ReportsUtilityUtilityAsset;

use Craft;
use craft\base\Utility;

/**
 * Reports Utility
 *
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class ReportsUtility extends Utility
{
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('reports', 'ReportsUtility');
    }

    /**
     * @inheritdoc
     */
    public static function id(): string
    {
        return 'reports-reports-utility';
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        return Craft::getAlias("@kingdomadvisors/reports/assetbundles/reportsutilityutility/dist/img/ReportsUtility-icon.svg");
    }

    /**
     * @inheritdoc
     */
    public static function badgeCount(): int
    {
        return 0;
    }

    /**
     * @inheritdoc
     */
    public static function contentHtml(): string
    {
        Craft::$app->getView()->registerAssetBundle(ReportsUtilityUtilityAsset::class);

        $someVar = 'Have a nice day!';
        return Craft::$app->getView()->renderTemplate(
            'reports/_components/utilities/ReportsUtility_content',
            [
                'someVar' => $someVar
            ]
        );
    }
}
