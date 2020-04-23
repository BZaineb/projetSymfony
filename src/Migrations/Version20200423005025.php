<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200423005025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_excursion DROP FOREIGN KEY FK_8AFF329A56B74360');
        $this->addSql('DROP INDEX IDX_8AFF329A56B74360 ON detail_excursion');
        $this->addSql('ALTER TABLE detail_excursion DROP detail_excursion_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_excursion ADD detail_excursion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_excursion ADD CONSTRAINT FK_8AFF329A56B74360 FOREIGN KEY (detail_excursion_id) REFERENCES excursion (id)');
        $this->addSql('CREATE INDEX IDX_8AFF329A56B74360 ON detail_excursion (detail_excursion_id)');
    }
}
