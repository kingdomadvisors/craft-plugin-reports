<?php
/**
 * Reports plugin for Craft CMS 3.x
 *
 * Internal Reporting
 *
 * @link      https://selvin.co
 * @copyright Copyright (c) 2018 Selvin Ortiz
 */

namespace kingdomadvisors\reports\assetbundles\reportsutilityutility;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class ReportsUtilityUtilityAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@kingdomadvisors/reports/assetbundles/reportsutilityutility/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/ReportsUtility.js',
        ];

        $this->css = [
            'css/ReportsUtility.css',
        ];

        parent::init();
    }
}
