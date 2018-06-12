<?php
/**
 * Reports plugin for Craft CMS 3.x
 *
 * Internal Reporting
 *
 * @link      https://selvin.co
 * @copyright Copyright (c) 2018 Selvin Ortiz
 */

namespace kingdomadvisors\reports\assetbundles\queryfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class QueryFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@kingdomadvisors/reports/assetbundles/queryfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Query.js',
        ];

        $this->css = [
            'css/Query.css',
        ];

        parent::init();
    }
}
