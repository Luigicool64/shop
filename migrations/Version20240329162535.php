<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329162535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supporter DROP FOREIGN KEY FK_3F06E55CD11A2CF');
        $this->addSql('DROP INDEX IDX_3F06E55CD11A2CF ON supporter');
        $this->addSql('ALTER TABLE supporter CHANGE produits_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supporter ADD CONSTRAINT FK_3F06E55F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_3F06E55F347EFB ON supporter (produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supporter DROP FOREIGN KEY FK_3F06E55F347EFB');
        $this->addSql('DROP INDEX IDX_3F06E55F347EFB ON supporter');
        $this->addSql('ALTER TABLE supporter CHANGE produit_id produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supporter ADD CONSTRAINT FK_3F06E55CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_3F06E55CD11A2CF ON supporter (produits_id)');
    }
}
