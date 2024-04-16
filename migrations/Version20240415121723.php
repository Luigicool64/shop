<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415121723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_produit DROP FOREIGN KEY FK_71A8F22DA76ED395');
        $this->addSql('ALTER TABLE user_produit DROP FOREIGN KEY FK_71A8F22DF347EFB');
        $this->addSql('DROP TABLE user_produit');
        $this->addSql('ALTER TABLE user ADD aimer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DAC3E6F6 FOREIGN KEY (aimer_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DAC3E6F6 ON user (aimer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_produit (user_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_71A8F22DF347EFB (produit_id), INDEX IDX_71A8F22DA76ED395 (user_id), PRIMARY KEY(user_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_produit ADD CONSTRAINT FK_71A8F22DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_produit ADD CONSTRAINT FK_71A8F22DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DAC3E6F6');
        $this->addSql('DROP INDEX IDX_8D93D649DAC3E6F6 ON user');
        $this->addSql('ALTER TABLE user DROP aimer_id');
    }
}
