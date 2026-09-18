<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260918073135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, numero_passeport VARCHAR(50) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, date_naissance DATE DEFAULT NULL, lieu_naissance VARCHAR(150) DEFAULT NULL, nationalite VARCHAR(100) DEFAULT NULL, sexe VARCHAR(20) DEFAULT NULL, date_emission DATE DEFAULT NULL, date_expiration DATE DEFAULT NULL, pays_emission VARCHAR(100) DEFAULT NULL, telephone VARCHAR(30) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, pays VARCHAR(100) DEFAULT NULL, code_postal VARCHAR(20) DEFAULT NULL, profession VARCHAR(150) DEFAULT NULL, situation_familiale VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EMAIL ON app_user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_PASSEPORT ON app_user (numero_passeport)');
        $this->addSql('CREATE TABLE document (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie VARCHAR(30) NOT NULL, nom_fichier VARCHAR(255) DEFAULT NULL, fichier_size INTEGER DEFAULT NULL, updated_at DATETIME NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_D8698A76A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D8698A76A76ED395 ON document (user_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE app_user');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
