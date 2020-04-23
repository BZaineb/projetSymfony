<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200423004336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_visite DROP FOREIGN KEY FK_A2569520D03209EC');
        $this->addSql('DROP INDEX IDX_A2569520D03209EC ON detail_visite');
        $this->addSql('ALTER TABLE detail_visite DROP detail_visite_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_visite ADD detail_visite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_visite ADD CONSTRAINT FK_A2569520D03209EC FOREIGN KEY (detail_visite_id) REFERENCES visite (id)');
        $this->addSql('CREATE INDEX IDX_A2569520D03209EC ON detail_visite (detail_visite_id)');
    }
}
