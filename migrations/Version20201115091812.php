<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201115091812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE employee_report_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee_report (id INT NOT NULL, user_id INT NOT NULL, user_dish_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ED1EB311A76ED395 ON employee_report (user_id)');
        $this->addSql('CREATE INDEX IDX_ED1EB3114C83AEC1 ON employee_report (user_dish_id)');
        $this->addSql('ALTER TABLE employee_report ADD CONSTRAINT FK_ED1EB311A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_report ADD CONSTRAINT FK_ED1EB3114C83AEC1 FOREIGN KEY (user_dish_id) REFERENCES user_dish (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dish ADD price INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE employee_report_id_seq CASCADE');
        $this->addSql('DROP TABLE employee_report');
        $this->addSql('ALTER TABLE dish DROP price');
    }
}
