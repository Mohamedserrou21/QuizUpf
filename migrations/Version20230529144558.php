<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529144558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751C79B0447');
        $this->addSql('DROP INDEX IDX_32993751C79B0447 ON score');
        $this->addSql('ALTER TABLE score CHANGE quizs_id quiz_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_32993751853CD175 ON score (quiz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751853CD175');
        $this->addSql('DROP INDEX IDX_32993751853CD175 ON score');
        $this->addSql('ALTER TABLE score CHANGE quiz_id quizs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751C79B0447 FOREIGN KEY (quizs_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_32993751C79B0447 ON score (quizs_id)');
    }
}
