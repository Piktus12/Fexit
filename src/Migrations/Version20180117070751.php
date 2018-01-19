<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117070751 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ask CHANGE value value DOUBLE PRECISION NOT NULL, CHANGE volume volume DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE bid CHANGE value value DOUBLE PRECISION NOT NULL, CHANGE volume volume DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ask CHANGE value value NUMERIC(10, 0) NOT NULL, CHANGE volume volume NUMERIC(10, 0) NOT NULL');
        $this->addSql('ALTER TABLE bid CHANGE value value NUMERIC(10, 0) NOT NULL, CHANGE volume volume NUMERIC(10, 0) NOT NULL');
    }
}
