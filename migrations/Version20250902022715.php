<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250902022715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biblioteca_libro (id INT AUTO_INCREMENT NOT NULL, biblioteca_id INT NOT NULL, libro_id INT NOT NULL, cantidad INT NOT NULL, puntuacion DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1FAB4C6F6A5EDAE9 (biblioteca_id), INDEX IDX_1FAB4C6FC0238522 (libro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biblioteca_libro ADD CONSTRAINT FK_1FAB4C6F6A5EDAE9 FOREIGN KEY (biblioteca_id) REFERENCES biblioteca (id)');
        $this->addSql('ALTER TABLE biblioteca_libro ADD CONSTRAINT FK_1FAB4C6FC0238522 FOREIGN KEY (libro_id) REFERENCES libro (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biblioteca_libro DROP FOREIGN KEY FK_1FAB4C6F6A5EDAE9');
        $this->addSql('ALTER TABLE biblioteca_libro DROP FOREIGN KEY FK_1FAB4C6FC0238522');
        $this->addSql('DROP TABLE biblioteca_libro');
    }
}
