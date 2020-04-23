<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200423010642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE description_excursion ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE description_excursion ADD CONSTRAINT FK_A7BE301CC54C8C93 FOREIGN KEY (type_id) REFERENCES excursion (id)');
        $this->addSql('CREATE INDEX IDX_A7BE301CC54C8C93 ON description_excursion (type_id)');
        $this->addSql('ALTER TABLE detail_excursion ADD reservation_id INT DEFAULT NULL, ADD excursion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_excursion ADD CONSTRAINT FK_8AFF329AB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE detail_excursion ADD CONSTRAINT FK_8AFF329A4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id)');
        $this->addSql('CREATE INDEX IDX_8AFF329AB83297E7 ON detail_excursion (reservation_id)');
        $this->addSql('CREATE INDEX IDX_8AFF329A4AB4296F ON detail_excursion (excursion_id)');
        $this->addSql('ALTER TABLE detail_visite ADD reservation_id INT DEFAULT NULL, ADD visite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_visite ADD CONSTRAINT FK_A2569520B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE detail_visite ADD CONSTRAINT FK_A2569520C1C5DC59 FOREIGN KEY (visite_id) REFERENCES visite (id)');
        $this->addSql('CREATE INDEX IDX_A2569520B83297E7 ON detail_visite (reservation_id)');
        $this->addSql('CREATE INDEX IDX_A2569520C1C5DC59 ON detail_visite (visite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE description_excursion DROP FOREIGN KEY FK_A7BE301CC54C8C93');
        $this->addSql('DROP INDEX IDX_A7BE301CC54C8C93 ON description_excursion');
        $this->addSql('ALTER TABLE description_excursion DROP type_id');
        $this->addSql('ALTER TABLE detail_excursion DROP FOREIGN KEY FK_8AFF329AB83297E7');
        $this->addSql('ALTER TABLE detail_excursion DROP FOREIGN KEY FK_8AFF329A4AB4296F');
        $this->addSql('DROP INDEX IDX_8AFF329AB83297E7 ON detail_excursion');
        $this->addSql('DROP INDEX IDX_8AFF329A4AB4296F ON detail_excursion');
        $this->addSql('ALTER TABLE detail_excursion DROP reservation_id, DROP excursion_id');
        $this->addSql('ALTER TABLE detail_visite DROP FOREIGN KEY FK_A2569520B83297E7');
        $this->addSql('ALTER TABLE detail_visite DROP FOREIGN KEY FK_A2569520C1C5DC59');
        $this->addSql('DROP INDEX IDX_A2569520B83297E7 ON detail_visite');
        $this->addSql('DROP INDEX IDX_A2569520C1C5DC59 ON detail_visite');
        $this->addSql('ALTER TABLE detail_visite DROP reservation_id, DROP visite_id');
    }
}
