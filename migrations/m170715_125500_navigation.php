<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

use yii\db\Migration;

class m170715_125500_navigation extends Migration
{
    const TABLE_NAME = '{{%navigation}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'DEFAULT CHARSET=utf8 ENGINE = InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->bigPrimaryKey(),
            'root' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'lvl' => $this->smallInteger(5)->notNull(),
            'name' => $this->string(60)->notNull(),
            'slug' => $this->string(60)->notNull(),
            'route' => $this->string(60)->notNull(),
            'route_params' => $this->text(),
            'access_roles' => $this->text(),
            'page_title' => $this->string(255),
            'meta_description' => $this->text(),
            'meta_keywords' => $this->text(),
            'link_options' => $this->text(),
            'icon' => $this->string(255),
            'icon_type' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'active' => $this->boolean()->notNull()->defaultValue(true),
            'selected' => $this->boolean()->notNull()->defaultValue(false),
            'disabled' => $this->boolean()->notNull()->defaultValue(false),
            'readonly' => $this->boolean()->notNull()->defaultValue(false),
            'visible' => $this->boolean()->notNull()->defaultValue(true),
            'collapsed' => $this->boolean()->notNull()->defaultValue(false),
            'movable_u' => $this->boolean()->notNull()->defaultValue(true),
            'movable_d' => $this->boolean()->notNull()->defaultValue(true),
            'movable_l' => $this->boolean()->notNull()->defaultValue(true),
            'movable_r' => $this->boolean()->notNull()->defaultValue(true),
            'removable' => $this->boolean()->notNull()->defaultValue(true),
            'removable_all' => $this->boolean()->notNull()->defaultValue(false)
        ], $tableOptions);

        $this->createIndex('tree_NK1', self::TABLE_NAME, 'root');
        $this->createIndex('tree_NK2', self::TABLE_NAME, 'lft');
        $this->createIndex('tree_NK3', self::TABLE_NAME, 'rgt');
        $this->createIndex('tree_NK4', self::TABLE_NAME, 'lvl');
        $this->createIndex('tree_NK5', self::TABLE_NAME, 'active');
        $this->createIndex('tree_NK6', self::TABLE_NAME, 'slug', true);

        $this->insert(self::TABLE_NAME, [
            'id' => 1,
            'root' => 1,
            'lft' => 1,
            'rgt' => 2,
            'lvl' => 0,
            'name' => 'Site main menu',
            'slug' => 'site-mainmenu',
            'route' => '/',
        ]);

        $this->insert(self::TABLE_NAME, [
            'id' => 2,
            'root' => 2,
            'lft' => 1,
            'rgt' => 2,
            'lvl' => 0,
            'name' => 'Admin main menu',
            'slug' => 'admin-mainmenu',
            'route' => '/admin',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
