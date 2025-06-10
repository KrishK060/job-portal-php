<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250610052317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_seeker_profile DROP FOREIGN KEY FK_7CB26CC99D86650F');
        $this->addSql('DROP INDEX UNIQ_7CB26CC99D86650F ON job_seeker_profile');
        $this->addSql('ALTER TABLE job_seeker_profile CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE job_seeker_profile ADD CONSTRAINT FK_7CB26CC9A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CB26CC9A76ED395 ON job_seeker_profile (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_seeker_profile DROP FOREIGN KEY FK_7CB26CC9A76ED395');
        $this->addSql('DROP INDEX UNIQ_7CB26CC9A76ED395 ON job_seeker_profile');
        $this->addSql('ALTER TABLE job_seeker_profile CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE job_seeker_profile ADD CONSTRAINT FK_7CB26CC99D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CB26CC99D86650F ON job_seeker_profile (user_id_id)');
    }
}
