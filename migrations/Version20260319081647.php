<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260319081647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__form_field_reference AS SELECT author_id, id FROM form_field_reference');
        $this->addSql('DROP TABLE form_field_reference');
        $this->addSql('CREATE TABLE form_field_reference (id VARCHAR(255) NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_FBC69240F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO form_field_reference (author_id, id) SELECT author_id, id FROM __temp__form_field_reference');
        $this->addSql('DROP TABLE __temp__form_field_reference');
        $this->addSql('CREATE INDEX IDX_FBC69240F675F31B ON form_field_reference (author_id)');
        $this->addSql('ALTER TABLE post ADD COLUMN title_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD COLUMN summary_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD COLUMN content_id CLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__form_field_reference AS SELECT id, author_id FROM form_field_reference');
        $this->addSql('DROP TABLE form_field_reference');
        $this->addSql('CREATE TABLE form_field_reference (author_id INTEGER NOT NULL, id VARCHAR(255) NOT NULL, CONSTRAINT FK_FBC69240F675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO form_field_reference (id, author_id) SELECT id, author_id FROM __temp__form_field_reference');
        $this->addSql('DROP TABLE __temp__form_field_reference');
        $this->addSql('CREATE INDEX IDX_FBC69240F675F31B ON form_field_reference (author_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, author_id, title, slug, summary, content, published_at FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, author_id, title, slug, summary, content, published_at) SELECT id, author_id, title, slug, summary, content, published_at FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
    }
}
