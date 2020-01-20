<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200120110720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE widget_packs (id SERIAL NOT NULL, pack_size INT NOT NULL, PRIMARY KEY(id))');

    }

    public function down(Schema $schema) : void
    {
		$this->addSql('DROP TABLE widget_packs');
    }
}
