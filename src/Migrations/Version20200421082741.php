<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200421082741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE description_excursion (id INT AUTO_INCREMENT NOT NULL, detail LONGTEXT NOT NULL, photo VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_excursion (id INT AUTO_INCREMENT NOT NULL, detail_excursion_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_8AFF329A56B74360 (detail_excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_visite (id INT AUTO_INCREMENT NOT NULL, detail_visite_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_A2569520D03209EC (detail_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE excursion (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(100) NOT NULL, duree_recommandee INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, pseudo VARCHAR(50) NOT NULL, pays VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, duree_recommandee INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_excursion ADD CONSTRAINT FK_8AFF329A56B74360 FOREIGN KEY (detail_excursion_id) REFERENCES excursion (id)');
        $this->addSql('ALTER TABLE detail_visite ADD CONSTRAINT FK_A2569520D03209EC FOREIGN KEY (detail_visite_id) REFERENCES visite (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_excursion DROP FOREIGN KEY FK_8AFF329A56B74360');
        $this->addSql('ALTER TABLE detail_visite DROP FOREIGN KEY FK_A2569520D03209EC');
        $this->addSql('DROP TABLE description_excursion');
        $this->addSql('DROP TABLE detail_excursion');
        $this->addSql('DROP TABLE detail_visite');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visite');
    }
}
