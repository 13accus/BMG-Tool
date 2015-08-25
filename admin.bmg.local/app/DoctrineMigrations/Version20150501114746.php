<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150501114746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql("CREATE  TABLE IF NOT EXISTS time_period (
                            time_period_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
                          time_period_name VARCHAR(45) NULL DEFAULT NULL ,
                          status_id INT(10) UNSIGNED NOT NULL ,
                          PRIMARY KEY (time_period_id) ,
                          INDEX fk_time_period_status1_idx (status_id ASC) ,
                          CONSTRAINT fk_time_period_status1
                            FOREIGN KEY (status_id )
                            REFERENCES status (status_id )
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION)
                        ENGINE = InnoDB
                        DEFAULT CHARACTER SET = latin1
                        COLLATE = latin1_swedish_ci");

        $this->addSql("ALTER TABLE user_experience_link ADD COLUMN time_period_id INT(10) UNSIGNED NULL DEFAULT NULL  AFTER user_experience_link_rate ,
  ADD CONSTRAINT fk_user_experience_link_time_period1
  FOREIGN KEY (time_period_id )
  REFERENCES time_period (time_period_id )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX fk_user_experience_link_time_period1_idx (time_period_id ASC)");

        $this->addSql("ALTER TABLE user_rental_link ADD COLUMN time_period_id INT(10) UNSIGNED NULL DEFAULT NULL  AFTER user_rental_link_fee ,
  ADD CONSTRAINT fk_user_rental_link_time_period1
  FOREIGN KEY (time_period_id )
  REFERENCES time_period (time_period_id )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX fk_user_rental_link_time_period1_idx (time_period_id ASC)");

        $this->addSql("INSERT INTO `time_period` (`time_period_id`, `time_period_name`, `status_id`) VALUES (1, 'Per hour', 1),(2, 'Half day (5 hours)', 1),(3, 'Full day (10 hours)', 1)");



    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
