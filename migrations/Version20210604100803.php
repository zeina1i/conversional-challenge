<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604100803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, event_name VARCHAR(255) NOT NULL, event_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_items (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, previous_periods_new_events LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', current_period_new_events LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_DCC4B9F8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoices (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, events_snapshot LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', total_price DOUBLE PRECISION DEFAULT NULL, events_frequencies LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_6A2F2F959395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sessions (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, appointment_time DATETIME NOT NULL, activation_time DATETIME NOT NULL, INDEX IDX_9A609D13A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, first_activation_id INT DEFAULT NULL, first_appointment_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, paid DOUBLE PRECISION NOT NULL, registered_at DATETIME NOT NULL, first_appointment_time DATETIME NOT NULL, first_activation_time DATETIME NOT NULL, INDEX IDX_1483A5E99395C3F3 (customer_id), INDEX IDX_1483A5E996166EB0 (first_activation_id), INDEX IDX_1483A5E9FE70997 (first_appointment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice_items ADD CONSTRAINT FK_DCC4B9F8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F959395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D13A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E99395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E996166EB0 FOREIGN KEY (first_activation_id) REFERENCES sessions (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9FE70997 FOREIGN KEY (first_appointment_id) REFERENCES sessions (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoices DROP FOREIGN KEY FK_6A2F2F959395C3F3');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E99395C3F3');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E996166EB0');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9FE70997');
        $this->addSql('ALTER TABLE invoice_items DROP FOREIGN KEY FK_DCC4B9F8A76ED395');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D13A76ED395');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE invoice_items');
        $this->addSql('DROP TABLE invoices');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP TABLE users');
    }
}
