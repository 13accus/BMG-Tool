<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150210143228 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	
        $this->addSql("ALTER TABLE user DROP FOREIGN KEY fk_user_city1 ;");
        $this->addSql("ALTER TABLE user CHANGE COLUMN city_id city_id INT(10) UNSIGNED NULL DEFAULT NULL  , DROP FOREIGN KEY fk_user_status1 ;");
        $this->addSql("ALTER TABLE user
    	ADD CONSTRAINT fk_user_status1
    	FOREIGN KEY (status_id )
    	REFERENCES status (status_id )
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    	ADD CONSTRAINT fk_user_city1
    	FOREIGN KEY (city_id )
    	REFERENCES city (city_id )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION;");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
