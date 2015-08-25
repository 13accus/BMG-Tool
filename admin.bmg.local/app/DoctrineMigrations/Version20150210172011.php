<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150210172011 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        
    	$this->addSql("ALTER TABLE user ADD COLUMN user_gender VARCHAR(1) NULL DEFAULT NULL  AFTER user_lastupdate_datetime , DROP FOREIGN KEY fk_user_status1 ;");
    	$this->addSql("ALTER TABLE user
    	ADD CONSTRAINT fk_user_status1
    	FOREIGN KEY (status_id )
    	REFERENCES status (status_id )
    	ON DELETE CASCADE
    	ON UPDATE CASCADE;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
