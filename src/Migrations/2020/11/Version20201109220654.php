<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109220654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flag_entity DROP FOREIGN KEY FK_E37C49B9919FE4E5');
        $this->addSql('DROP TABLE flag');
        $this->addSql('DROP TABLE flag_entity');
        $this->addSql('CREATE FULLTEXT INDEX genre_ft_idx ON genre (genre_name)');
    }

    public function down(Schema $schema) : void
    {
        $this->throwIrreversibleMigrationException();
    }
}
