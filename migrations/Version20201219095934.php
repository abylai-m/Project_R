<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201219095934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("
            insert into \"user\" (id, email, roles, password, created_at, updated_at)
            values  (nextval('user_id_seq'), 'admin@mail.com', '[\"ROLE_ADMIN\"]', '$2y$13$9s3OTi9hCX2OfL2iXioZM.3NNlZlAJtKqwWCRN1xhkhnaFh6UEhA6', now(), now());
        ");

        $this->addSql("
            insert into \"table\" (id, number, created_at, updated_at)
            values (nextval('table_id_seq'), 1, now(), now());
        ");
        $this->addSql("
            insert into \"table\" (id, number, created_at, updated_at)
            values (nextval('table_id_seq'), 2, now(), now());
        ");
        $this->addSql("
            insert into \"table\" (id, number, created_at, updated_at)
            values (nextval('table_id_seq'), 3, now(), now());
        ");
        $this->addSql("
            insert into \"table\" (id, number, created_at, updated_at)
            values (nextval('table_id_seq'), 4, now(), now());
        ");
        $this->addSql("
            insert into \"table\" (id, number, created_at, updated_at)
            values (nextval('table_id_seq'), 5, now(), now());
        ");

        $this->addSql("
            insert into dish (id, name, created_at, updated_at, price) 
            values (nextval('dish_id_seq'), 'Dish 1', now(), now(), 1000);
        ");
        $this->addSql("
            insert into dish (id, name, created_at, updated_at, price) 
            values (nextval('dish_id_seq'), 'Dish 2', now(), now(), 2000);
        ");
        $this->addSql("
            insert into dish (id, name, created_at, updated_at, price) 
            values (nextval('dish_id_seq'), 'Dish 3', now(), now(), 3000);
        ");
        $this->addSql("
            insert into dish (id, name, created_at, updated_at, price) 
            values (nextval('dish_id_seq'), 'Dish 4', now(), now(), 4000);
        ");
        $this->addSql("
            insert into dish (id, name, created_at, updated_at, price) 
            values (nextval('dish_id_seq'), 'Dish 5', now(), now(), 5000);
        ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
