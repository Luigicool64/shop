<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329121114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supporter ADD support_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supporter ADD CONSTRAINT FK_3F06E55315B405 FOREIGN KEY (support_id) REFERENCES support (id)');
        $this->addSql('CREATE INDEX IDX_3F06E55315B405 ON supporter (support_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supporter DROP FOREIGN KEY FK_3F06E55315B405');
        $this->addSql('DROP INDEX IDX_3F06E55315B405 ON supporter');
        $this->addSql('ALTER TABLE supporter DROP support_id');
    }
}
