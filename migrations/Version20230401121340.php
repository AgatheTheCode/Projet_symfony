<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230401121340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_categories (produits_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_3A9B64EDCD11A2CF (produits_id), INDEX IDX_3A9B64EDA21214B7 (categories_id), PRIMARY KEY(produits_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits_genre (produits_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_F62747B6CD11A2CF (produits_id), INDEX IDX_F62747B64296D31F (genre_id), PRIMARY KEY(produits_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_categories ADD CONSTRAINT FK_3A9B64EDCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_categories ADD CONSTRAINT FK_3A9B64EDA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_genre ADD CONSTRAINT FK_F62747B6CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_genre ADD CONSTRAINT FK_F62747B64296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C124D3F8A');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C9F34925F');
        $this->addSql('DROP INDEX UNIQ_BE2DDF8C9F34925F ON produits');
        $this->addSql('DROP INDEX UNIQ_BE2DDF8C124D3F8A ON produits');
        $this->addSql('ALTER TABLE produits DROP id_categorie_id, DROP id_genre_id, CHANGE qte_produit qte_produit INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_categories DROP FOREIGN KEY FK_3A9B64EDCD11A2CF');
        $this->addSql('ALTER TABLE produits_categories DROP FOREIGN KEY FK_3A9B64EDA21214B7');
        $this->addSql('ALTER TABLE produits_genre DROP FOREIGN KEY FK_F62747B6CD11A2CF');
        $this->addSql('ALTER TABLE produits_genre DROP FOREIGN KEY FK_F62747B64296D31F');
        $this->addSql('DROP TABLE produits_categories');
        $this->addSql('DROP TABLE produits_genre');
        $this->addSql('ALTER TABLE produits ADD id_categorie_id INT NOT NULL, ADD id_genre_id INT NOT NULL, CHANGE qte_produit qte_produit INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C124D3F8A FOREIGN KEY (id_genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE2DDF8C9F34925F ON produits (id_categorie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE2DDF8C124D3F8A ON produits (id_genre_id)');
    }
}
