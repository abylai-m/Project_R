<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114083432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE user_dish_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_dish (id INT NOT NULL, user_id INT DEFAULT NULL, dish_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EFFCC071A76ED395 ON user_dish (user_id)');
        $this->addSql('CREATE INDEX IDX_EFFCC071148EB0CB ON user_dish (dish_id)');
        $this->addSql('ALTER TABLE user_dish ADD CONSTRAINT FK_EFFCC071A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_dish ADD CONSTRAINT FK_EFFCC071148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_dish_id_seq CASCADE');
        $this->addSql('DROP TABLE user_dish');
    }
}
