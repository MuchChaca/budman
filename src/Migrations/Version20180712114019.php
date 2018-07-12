<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180712114019 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, period_id INT DEFAULT NULL, delta NUMERIC(16, 2) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, last_updated DATETIME DEFAULT NULL, INDEX IDX_2FB3D0EEF675F31B (author_id), INDEX IDX_2FB3D0EEEC8B7ADE (period_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, last_updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entry (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, value NUMERIC(20, 2) DEFAULT NULL, unit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entry_prevision (entry_id INT NOT NULL, prevision_id INT NOT NULL, INDEX IDX_6682939CBA364942 (entry_id), INDEX IDX_6682939C29E28AF8 (prevision_id), PRIMARY KEY(entry_id, prevision_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entry_tag (entry_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F035C9E5BA364942 (entry_id), INDEX IDX_F035C9E5BAD26311 (tag_id), PRIMARY KEY(entry_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prevision (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, label VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT NULL, value NUMERIC(20, 2) DEFAULT NULL, last_updated DATETIME DEFAULT NULL, INDEX IDX_1EEB1DDE166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles TEXT NOT NULL, date_creation DATETIME DEFAULT NULL, last_updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE period (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, date_begin DATETIME DEFAULT NULL, last_value INT DEFAULT NULL, last_unit VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, last_updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, last_updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEEC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE entry_prevision ADD CONSTRAINT FK_6682939CBA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entry_prevision ADD CONSTRAINT FK_6682939C29E28AF8 FOREIGN KEY (prevision_id) REFERENCES prevision (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entry_tag ADD CONSTRAINT FK_F035C9E5BA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entry_tag ADD CONSTRAINT FK_F035C9E5BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prevision ADD CONSTRAINT FK_1EEB1DDE166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prevision DROP FOREIGN KEY FK_1EEB1DDE166D1F9C');
        $this->addSql('ALTER TABLE entry_tag DROP FOREIGN KEY FK_F035C9E5BAD26311');
        $this->addSql('ALTER TABLE entry_prevision DROP FOREIGN KEY FK_6682939CBA364942');
        $this->addSql('ALTER TABLE entry_tag DROP FOREIGN KEY FK_F035C9E5BA364942');
        $this->addSql('ALTER TABLE entry_prevision DROP FOREIGN KEY FK_6682939C29E28AF8');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEF675F31B');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEEC8B7ADE');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE entry');
        $this->addSql('DROP TABLE entry_prevision');
        $this->addSql('DROP TABLE entry_tag');
        $this->addSql('DROP TABLE prevision');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE period');
        $this->addSql('DROP TABLE category');
    }
}
