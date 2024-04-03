<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329102708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support ADD supporter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA54AF59D5D FOREIGN KEY (supporter_id) REFERENCES supporter (id)');
        $this->addSql('CREATE INDEX IDX_8004EBA54AF59D5D ON support (supporter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA54AF59D5D');
        $this->addSql('DROP INDEX IDX_8004EBA54AF59D5D ON support');
        $this->addSql('ALTER TABLE support DROP supporter_id');
    }
}
