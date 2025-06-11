<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250611112205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applications (id INT AUTO_INCREMENT NOT NULL, jobseeker_id INT NOT NULL, job_id INT NOT NULL, status VARCHAR(255) NOT NULL, applied_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', full_name VARCHAR(255) NOT NULL, experience INT NOT NULL, INDEX IDX_F7C966F04CF2B5A9 (jobseeker_id), INDEX IDX_F7C966F0BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F04CF2B5A9 FOREIGN KEY (jobseeker_id) REFERENCES job_seeker_profile (id)');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F0BE04EA9 FOREIGN KEY (job_id) REFERENCES job_post (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applications DROP FOREIGN KEY FK_F7C966F04CF2B5A9');
        $this->addSql('ALTER TABLE applications DROP FOREIGN KEY FK_F7C966F0BE04EA9');
        $this->addSql('DROP TABLE applications');
    }
}
