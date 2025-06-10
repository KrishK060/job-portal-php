<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250610094142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED288900185');
        $this->addSql('DROP INDEX IDX_DB0A5ED288900185 ON education');
        $this->addSql('ALTER TABLE education CHANGE profile_id_id profile_id INT NOT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2CCFA12B8 FOREIGN KEY (profile_id) REFERENCES job_seeker_profile (id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2CCFA12B8 ON education (profile_id)');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10388900185');
        $this->addSql('DROP INDEX IDX_590C10388900185 ON experience');
        $this->addSql('ALTER TABLE experience CHANGE profile_id_id profile_id INT NOT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103CCFA12B8 FOREIGN KEY (profile_id) REFERENCES job_seeker_profile (id)');
        $this->addSql('CREATE INDEX IDX_590C103CCFA12B8 ON experience (profile_id)');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D531167088900185');
        $this->addSql('DROP INDEX IDX_D531167088900185 ON skills');
        $this->addSql('ALTER TABLE skills CHANGE profile_id_id profile_id INT NOT NULL');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670CCFA12B8 FOREIGN KEY (profile_id) REFERENCES job_seeker_profile (id)');
        $this->addSql('CREATE INDEX IDX_D5311670CCFA12B8 ON skills (profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2CCFA12B8');
        $this->addSql('DROP INDEX IDX_DB0A5ED2CCFA12B8 ON education');
        $this->addSql('ALTER TABLE education CHANGE profile_id profile_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED288900185 FOREIGN KEY (profile_id_id) REFERENCES job_seeker_profile (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DB0A5ED288900185 ON education (profile_id_id)');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D5311670CCFA12B8');
        $this->addSql('DROP INDEX IDX_D5311670CCFA12B8 ON skills');
        $this->addSql('ALTER TABLE skills CHANGE profile_id profile_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D531167088900185 FOREIGN KEY (profile_id_id) REFERENCES job_seeker_profile (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D531167088900185 ON skills (profile_id_id)');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103CCFA12B8');
        $this->addSql('DROP INDEX IDX_590C103CCFA12B8 ON experience');
        $this->addSql('ALTER TABLE experience CHANGE profile_id profile_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10388900185 FOREIGN KEY (profile_id_id) REFERENCES job_seeker_profile (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_590C10388900185 ON experience (profile_id_id)');
    }
}
