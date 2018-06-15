<?php
namespace kingdomadvisors\reports;

use kingdomadvisors\integrations\sproutreports\datasources\SproutReportCrmDataSource;
use kingdomadvisors\reports\models\Settings;
use kingdomadvisors\reports\fields\QueryField;
use kingdomadvisors\reports\elements\ReportElement;
use kingdomadvisors\reports\services\ReportsService;
use kingdomadvisors\reports\utilities\ReportsUtility;
use kingdomadvisors\reports\widgets\ReportsWidget;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\console\Application as Console;
use craft\web\UrlManager;
use craft\services\Elements;
use craft\services\Fields;
use craft\services\Utilities;
use craft\web\twig\variables\CraftVariable;
use craft\services\Dashboard;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class Reports
 *
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 *
 * @property  ReportsService $reportsService
 */
class Reports extends Plugin
{
    /**
     * @var string
     */
    public $schemaVersion = '0.1.0';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Craft::$app->view->registerTwigExtension(new ReportsExtension());

        if (Craft::$app instanceof Console)
        {
            $this->controllerNamespace = 'kingdomadvisors\reports\console\controllers';
        }

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $event->rules['siteActionTrigger1'] = 'reports/default';
            }
        );

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $event->rules['cpActionTrigger1'] = 'reports/default/do-something';
            }
        );

        Event::on(
            Elements::class,
            Elements::EVENT_REGISTER_ELEMENT_TYPES,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = ReportElement::class;
            }
        );

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = QueryField::class;
            }
        );

        Event::on(
            Utilities::class,
            Utilities::EVENT_REGISTER_UTILITY_TYPES,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = ReportsUtility::class;
            }
        );

        Event::on(
            Dashboard::class,
            Dashboard::EVENT_REGISTER_WIDGET_TYPES,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = ReportsWidget::class;
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /**
                 * @var CraftVariable $variable
                 */
                $variable = $event->sender;
                $variable->set('reports', ReportsVariable::class);
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function(PluginEvent $event) {
                if ($event->plugin === $this)
                {
                    Craft::info(
                        Craft::t(
                            'reports',
                            '{name} plugin installed',
                            ['name' => $this->name]
                        ),
                        __METHOD__
                    );
                }
            }
        );

        Craft::info(
            Craft::t(
                'reports',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    public function registerSproutReportsDataSources()
    {
        return [
            new SproutReportCrmDataSource()
        ];
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        try
        {
            return Craft::$app->view->renderTemplate(
                'reports/settings',
                [
                    'settings' => $this->getSettings()
                ]
            );
        }
        catch (\Exception $e)
        {
            Craft::error(Craft::t('reports', $e->getMessage()), __METHOD__);
        }
    }
}
