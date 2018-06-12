<?php
namespace kingdomadvisors\reports\migrations;

use Craft;
use craft\db\Migration;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class Install extends Migration
{
    const TABLE_GROUPS  = '{{%reports_groups}}';
    const TABLE_REPORTS = '{{%reports_reports}}';

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
            self::TABLE_REPORTS,
            [
                'id'            => $this->primaryKey(),
                'siteId'        => $this->integer()->notNull(),

                // Fields
                'name'          => $this->string()->notNull(),
                'handle'        => $this->string()->notNull(),
                'groupId'       => $this->integer(),
                'dataSource'    => $this->string(50),
                'description'   => $this->text(),
                'settings'      => $this->text(),
                'enabled'       => $this->boolean()->defaultValue(0),

                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid'         => $this->uid(),
            ]
        );

        $this->createTable(
            self::TABLE_GROUPS,
            [
                'id'            => $this->primaryKey(),
                'siteId'        => $this->integer()->notNull(),

                // Fields
                'name'          => $this->string()->notNull(),

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
                self::TABLE_REPORTS,
                'handle',
                true
            ),
            self::TABLE_REPORTS,
            'handle',
            true
        );

        $this->createIndex(
            $this->db->getIndexName(
                self::TABLE_GROUPS,
                'name',
                true
            ),
            self::TABLE_GROUPS,
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
            $this->db->getForeignKeyName(self::TABLE_REPORTS, 'siteId'),
            self::TABLE_REPORTS,
            'siteId',
            '{{%sites}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            $this->db->getForeignKeyName(self::TABLE_REPORTS, 'groupId'),
            self::TABLE_REPORTS,
            'groupId',
            self::TABLE_GROUPS,
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
    }

    /**
     * @return void
     */
    protected function removeTables()
    {
        $this->dropTableIfExists(self::TABLE_GROUPS);
        $this->dropTableIfExists(self::TABLE_REPORTS);
    }
}
