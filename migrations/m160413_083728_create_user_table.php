<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_table`.
 */
class m160413_083728_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /* $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }
 
        $this->createTable('{{%user_muser}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
			'data' => $this->string(255),
			'role' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions); */
		
		$this->addForeignKey('fk-service-parent', '{{%service}}', 'parent_id', 'service', 'id', 'SET NULL', 'RESTRICT');
		/* $this->addForeignKey('fk-menu-parent', 'menu', 'parent_id', 'menu', 'id', 'SET NULL', 'RESTRICT'); */
		
		/* $this->addForeignKey('fk-filter_portfolio-filter', 'filter_portfolio', 'filter_id', 'filter', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-filter_portfolio-portfolio', 'filter_portfolio', 'portfolio_id', 'portfolio', 'id', 'CASCADE', 'RESTRICT');
		
		$this->addForeignKey('fk-service_portfolio-filter', 'service_portfolio', 'service_id', 'service', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-service_portfolio-portfolio', 'service_portfolio', 'portfolio_id', 'portfolio', 'id', 'CASCADE', 'RESTRICT'); */
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
