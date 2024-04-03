<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329101858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274AF59D5D FOREIGN KEY (supporter_id) REFERENCES supporter (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC274AF59D5D ON produit (supporter_id)');
        $this->addSql('ALTER TABLE support ADD nom VARCHAR(255) NOT NULL, DROP support');
        $this->addSql('ALTER TABLE supporter ADD produits_id INT DEFAULT NULL, ADD support_id INT DEFAULT NULL, CHANGE stoch stock INT NOT NULL');
        $this->addSql('ALTER TABLE supporter ADD CONSTRAINT FK_3F06E55CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE supporter ADD CONSTRAINT FK_3F06E55315B405 FOREIGN KEY (support_id) REFERENCES support (id)');
        $this->addSql('CREATE INDEX IDX_3F06E55CD11A2CF ON supporter (produits_id)');
        $this->addSql('CREATE INDEX IDX_3F06E55315B405 ON supporter (support_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supporter DROP FOREIGN KEY FK_3F06E55CD11A2CF');
        $this->addSql('ALTER TABLE supporter DROP FOREIGN KEY FK_3F06E55315B405');
        $this->addSql('DROP INDEX IDX_3F06E55CD11A2CF ON supporter');
        $this->addSql('DROP INDEX IDX_3F06E55315B405 ON supporter');
        $this->addSql('ALTER TABLE supporter DROP produits_id, DROP support_id, CHANGE stock stoch INT NOT NULL');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274AF59D5D');
        $this->addSql('DROP INDEX IDX_29A5EC274AF59D5D ON produit');
        $this->addSql('ALTER TABLE support ADD support VARCHAR(50) NOT NULL, DROP nom');
    }
}
