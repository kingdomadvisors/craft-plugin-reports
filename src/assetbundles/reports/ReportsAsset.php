<?php
/**
 * Reports plugin for Craft CMS 3.x
 *
 * Internal Reporting
 *
 * @link      https://selvin.co
 * @copyright Copyright (c) 2018 Selvin Ortiz
 */

namespace kingdomadvisors\reports\assetbundles\Reports;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class ReportsAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@kingdomadvisors/reports/assetbundles/reports/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Reports.js',
        ];

        $this->css = [
            'css/Reports.css',
        ];

        parent::init();
    }
}
