<?php
namespace kingdomadvisors\integrations\sproutreports\datasources;

use barrelstrength\sproutbase\app\reports\base\DataSource;
use barrelstrength\sproutbase\app\reports\elements\Report;

use kingdomadvisors\reports\records\CrmUser;

class SproutReportCrmDataSource extends DataSource
{
    public function getName()
    {
        return 'Kingdom Advisors CRM';
    }

    public function getDescription()
    {
        return 'Create reports from data in our CRM';
    }

    public function getResults(Report $report, array $settings = [])
    {
        return CrmUser::findAll(['limit' => 10]);
    }
}
