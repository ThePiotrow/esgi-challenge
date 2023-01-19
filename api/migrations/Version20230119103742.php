<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119103742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket ADD event_id UUID NOT NULL');
        $this->addSql('ALTER TABLE ticket ALTER price TYPE DOUBLE PRECISION USING price::double precision');
        $this->addSql('ALTER TABLE ticket ALTER price DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN ticket.event_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA371F7E88B FOREIGN KEY (event_id) REFERENCES "event" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_97A0ADA371F7E88B ON ticket (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "ticket" DROP CONSTRAINT FK_97A0ADA371F7E88B');
        $this->addSql('DROP INDEX IDX_97A0ADA371F7E88B');
        $this->addSql('ALTER TABLE "ticket" DROP event_id');
        $this->addSql('ALTER TABLE "ticket" ALTER price TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "ticket" ALTER price DROP DEFAULT');
    }
}
