<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250609110034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, profile_id_id INT NOT NULL, startdate DATE NOT NULL, enddate DATE DEFAULT NULL, INDEX IDX_DB0A5ED288900185 (profile_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, profile_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, experience INT NOT NULL, INDEX IDX_590C10388900185 (profile_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_seeker_profile (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, full_name VARCHAR(255) NOT NULL, resume VARCHAR(255) NOT NULL, job_type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7CB26CC99D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, profile_id_id INT NOT NULL, skill_name VARCHAR(255) NOT NULL, INDEX IDX_D531167088900185 (profile_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED288900185 FOREIGN KEY (profile_id_id) REFERENCES job_seeker_profile (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10388900185 FOREIGN KEY (profile_id_id) REFERENCES job_seeker_profile (id)');
        $this->addSql('ALTER TABLE job_seeker_profile ADD CONSTRAINT FK_7CB26CC99D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D531167088900185 FOREIGN KEY (profile_id_id) REFERENCES job_seeker_profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED288900185');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10388900185');
        $this->addSql('ALTER TABLE job_seeker_profile DROP FOREIGN KEY FK_7CB26CC99D86650F');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D531167088900185');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE job_seeker_profile');
        $this->addSql('DROP TABLE skills');
    }
}
