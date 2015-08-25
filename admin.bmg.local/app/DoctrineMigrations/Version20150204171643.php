<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150204171643 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE  TABLE IF NOT EXISTS `bmg_tool`.`user_recovery_password_hash` (
  `user_recovery_password_hash_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT(10) UNSIGNED NOT NULL ,
  `user_recovery_password_hash_value` VARCHAR(200) NULL DEFAULT NULL ,
  PRIMARY KEY (`user_recovery_password_hash_id`) ,
  INDEX `fk_user_recovery_password_hash_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_user_recovery_password_hash_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `bmg_tool`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;
");


    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
