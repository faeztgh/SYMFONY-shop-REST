<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210530181255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, thumbnail VARCHAR(255) NOT NULL, is_lux BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, last_login DATETIME DEFAULT NULL, phone_no VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09F85E0677 ON customer (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09E7927C74 ON customer (email)');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) DEFAULT NULL, quantity BIGINT NOT NULL, color VARCHAR(255) DEFAULT NULL, dicount DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE product_category (product_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('CREATE TABLE seller (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, phone_no VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, name, email, subject, message, created_date FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, subject VARCHAR(255) NOT NULL COLLATE BINARY, message CLOB NOT NULL COLLATE BINARY, created_date DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO contact (id, name, email, subject, message, created_date) SELECT id, name, email, subject, message, created_date FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, full_name, email, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , email VARCHAR(255) DEFAULT NULL COLLATE BINARY, password VARCHAR(255) DEFAULT NULL COLLATE BINARY, last_name VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, last_login DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, username, roles, last_name, email, password) SELECT id, username, roles, full_name, email, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE seller');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, name, email, subject, message, created_date FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message CLOB NOT NULL, created_date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO contact (id, name, email, subject, message, created_date) SELECT id, name, email, subject, message, created_date FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, password, email FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO user (id, username, roles, password, email) SELECT id, username, roles, password, email FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
