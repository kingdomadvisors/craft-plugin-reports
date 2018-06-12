<?php
namespace kingdomadvisors\reports\migrations;

use Craft;
use craft\db\Migration;

use kingdomadvisors\reports\records\Group;
use kingdomadvisors\reports\records\Report;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class Install extends Migration
{
    public function safeUp()
    {
        if ($this->createTables())
        {
            $this->createIndexes();
            $this->addForeignKeys();

            Craft::$app->db->schema->refresh();

            $this->insertDefaultData();
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->removeTables();

        return true;
    }

    /**
     * @return bool
     */
    protected function createTables()
    {
        $this->createTable(
            Report::tableName(),
            [
                'id'          => $this->primaryKey(),
                'siteId'      => $this->integer()->notNull(),

                // Fields
                'name'        => $this->string()->notNull(),
                'handle'      => $this->string()->notNull(),
                'groupId'     => $this->integer(),
                'dataSource'  => $this->string(50),
                'description' => $this->text(),
                'settings'    => $this->text(),
                'enabled'     => $this->boolean()->defaultValue(1),

                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid'         => $this->uid(),
            ]
        );

        $this->createTable(
            Group::tableName(),
            [
                'id'     => $this->primaryKey(),
                'siteId' => $this->integer()->notNull(),

                // Fields
                'name'   => $this->string()->notNull(),

                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid'         => $this->uid(),
            ]
        );

        return true;
    }

    /**
     * @return void
     */
    protected function createIndexes()
    {
        $this->createIndex(
            $this->db->getIndexName(
                Report::tableName(),
                'handle',
                true
            ),
            Report::tableName(),
            'handle',
            true
        );

        $this->createIndex(
            $this->db->getIndexName(
                Group::tableName(),
                'name',
                true
            ),
            Group::tableName(),
            'name',
            true
        );
    }

    /**
     * @return void
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey(
            $this->db->getForeignKeyName(Report::tableName(), 'siteId'),
            Report::tableName(),
            'siteId',
            '{{%sites}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            $this->db->getForeignKeyName(Report::tableName(), 'groupId'),
            Report::tableName(),
            'groupId',
            Group::tableName(),
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @return void
     */
    protected function insertDefaultData()
    {
        $group         = new Group();
        $group->name   = 'Default';
        $group->siteId = Craft::$app->getSites()->currentSite->id;

        if ($group->save())
        {
            $report              = new Report();
            $report->name        = 'Example report powered by raw query.';
            $report->handle      = 'example';
            $report->siteId      = Craft::$app->getSites()->currentSite->id;
            $report->groupId     = $group->id;
            $report->description = '';
            $report->dataSource  = 'crm';

            $report->save();
        }
    }

    /**
     * @return void
     */
    protected function removeTables()
    {
        $this->dropTableIfExists(Report::tableName());
        $this->dropTableIfExists(Group::tableName());
    }
}
