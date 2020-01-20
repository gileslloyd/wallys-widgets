<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200120111435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Seeding DB with initial Pack Sizes';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO widget_packs (pack_size) VALUES (250), (500), (1000), (2000), (5000)");
    }

    public function down(Schema $schema) : void
    {
		$this->addSql("TRUNCATE TABLE widget_packs");
    }
}
