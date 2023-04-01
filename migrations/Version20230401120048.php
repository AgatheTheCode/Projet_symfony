<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230401120048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, id_genre_id INT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, note DOUBLE PRECISION DEFAULT NULL, description LONGTEXT NOT NULL, qte_produit INT NOT NULL, UNIQUE INDEX UNIQ_BE2DDF8C9F34925F (id_categorie_id), UNIQUE INDEX UNIQ_BE2DDF8C124D3F8A (id_genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C124D3F8A FOREIGN KEY (id_genre_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C9F34925F');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C124D3F8A');
        $this->addSql('DROP TABLE produits');
    }
}
