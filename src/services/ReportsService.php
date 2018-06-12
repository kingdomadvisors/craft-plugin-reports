<?php
/**
 * Reports plugin for Craft CMS 3.x
 *
 * Internal Reporting
 *
 * @link      https://selvin.co
 * @copyright Copyright (c) 2018 Selvin Ortiz
 */

namespace kingdomadvisors\reports\services;

use kingdomadvisors\reports\Reports;

use Craft;
use craft\base\Component;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class ReportsService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (Reports::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
