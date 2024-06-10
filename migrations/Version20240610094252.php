<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610094252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5D9F75A18C03F15C ON employee');
        $this->addSql('ALTER TABLE employee ADD emp_id VARCHAR(255) NOT NULL, ADD e_mail VARCHAR(255) NOT NULL, DROP employee_id, DROP email, CHANGE phone_number phone_no VARCHAR(20) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A17A663008 ON employee (emp_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5D9F75A17A663008 ON employee');
        $this->addSql('ALTER TABLE employee ADD employee_id VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, DROP emp_id, DROP e_mail, CHANGE phone_no phone_number VARCHAR(20) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A18C03F15C ON employee (employee_id)');
    }
}
