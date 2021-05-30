<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210530185312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP INDEX UNIQ_81398E09E7927C74');
        $this->addSql('DROP INDEX UNIQ_81398E09F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login, phone_no, address, country, is_verified FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , password VARCHAR(255) DEFAULT NULL COLLATE BINARY, email VARCHAR(255) DEFAULT NULL COLLATE BINARY, last_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, last_login DATETIME DEFAULT NULL, phone_no VARCHAR(20) NOT NULL COLLATE BINARY, address VARCHAR(255) NOT NULL COLLATE BINARY, country VARCHAR(255) NOT NULL COLLATE BINARY, is_verified BOOLEAN NOT NULL, first_name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO customer (id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login, phone_no, address, country, is_verified) SELECT id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login, phone_no, address, country, is_verified FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09E7927C74 ON customer (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09F85E0677 ON customer (username)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, brand, model, quantity, color, dicount, created_at, updated_at FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, seller_id INTEGER NOT NULL, brand VARCHAR(255) NOT NULL COLLATE BINARY, model VARCHAR(255) DEFAULT NULL COLLATE BINARY, quantity BIGINT NOT NULL, color VARCHAR(255) DEFAULT NULL COLLATE BINARY, dicount DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, full_name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, weight INTEGER DEFAULT NULL, brief_description VARCHAR(255) NOT NULL, description CLOB NOT NULL, thumbnail VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, CONSTRAINT FK_D34A04AD8DE820D9 FOREIGN KEY (seller_id) REFERENCES seller (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product (id, brand, model, quantity, color, dicount, created_at, updated_at) SELECT id, brand, model, quantity, color, dicount, created_at, updated_at FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04AD8DE820D9 ON product (seller_id)');
        $this->addSql('DROP INDEX IDX_CDFC735612469DE2');
        $this->addSql('DROP INDEX IDX_CDFC73564584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_category AS SELECT product_id, category_id FROM product_category');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('CREATE TABLE product_category (product_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(product_id, category_id), CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product_category (product_id, category_id) SELECT product_id, category_id FROM __temp__product_category');
        $this->addSql('DROP TABLE __temp__product_category');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, email, password, last_name, first_name, image, created_at, updated_at, last_login FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , email VARCHAR(255) DEFAULT NULL COLLATE BINARY, password VARCHAR(255) DEFAULT NULL COLLATE BINARY, last_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, last_login DATETIME DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, username, roles, email, password, last_name, first_name, image, created_at, updated_at, last_login) SELECT id, username, roles, email, password, last_name, first_name, image, created_at, updated_at, last_login FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, price DOUBLE PRECISION NOT NULL, weight INTEGER DEFAULT NULL, description CLOB NOT NULL COLLATE BINARY, brief_description VARCHAR(255) NOT NULL COLLATE BINARY, thumbnail VARCHAR(255) DEFAULT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, create_date DATETIME NOT NULL)');
        $this->addSql('DROP INDEX UNIQ_81398E09F85E0677');
        $this->addSql('DROP INDEX UNIQ_81398E09E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login, phone_no, address, country, is_verified FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, last_login DATETIME DEFAULT NULL, phone_no VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, first_name VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO customer (id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login, phone_no, address, country, is_verified) SELECT id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login, phone_no, address, country, is_verified FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09F85E0677 ON customer (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09E7927C74 ON customer (email)');
        $this->addSql('DROP INDEX IDX_D34A04AD8DE820D9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, brand, model, quantity, color, dicount, created_at, updated_at FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) DEFAULT NULL, quantity BIGINT NOT NULL, color VARCHAR(255) DEFAULT NULL, dicount DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO product (id, brand, model, quantity, color, dicount, created_at, updated_at) SELECT id, brand, model, quantity, color, dicount, created_at, updated_at FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('DROP INDEX IDX_CDFC73564584665A');
        $this->addSql('DROP INDEX IDX_CDFC735612469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_category AS SELECT product_id, category_id FROM product_category');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('CREATE TABLE product_category (product_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('INSERT INTO product_category (product_id, category_id) SELECT product_id, category_id FROM __temp__product_category');
        $this->addSql('DROP TABLE __temp__product_category');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, last_login DATETIME DEFAULT NULL, first_name VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO user (id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login) SELECT id, username, roles, password, email, first_name, last_name, image, created_at, updated_at, last_login FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
