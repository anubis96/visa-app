<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260918094115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_user ADD COLUMN photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_user ADD COLUMN photo_size INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__app_user AS SELECT id, email, roles, password, numero_passeport, nom, prenom, date_naissance, lieu_naissance, nationalite, sexe, date_emission, date_expiration, pays_emission, telephone, adresse, ville, pays, code_postal, profession, situation_familiale, statut, created_at, updated_at FROM app_user');
        $this->addSql('DROP TABLE app_user');
        $this->addSql('CREATE TABLE app_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, numero_passeport VARCHAR(50) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, date_naissance DATE DEFAULT NULL, lieu_naissance VARCHAR(150) DEFAULT NULL, nationalite VARCHAR(100) DEFAULT NULL, sexe VARCHAR(20) DEFAULT NULL, date_emission DATE DEFAULT NULL, date_expiration DATE DEFAULT NULL, pays_emission VARCHAR(100) DEFAULT NULL, telephone VARCHAR(30) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, pays VARCHAR(100) DEFAULT NULL, code_postal VARCHAR(20) DEFAULT NULL, profession VARCHAR(150) DEFAULT NULL, situation_familiale VARCHAR(50) DEFAULT NULL, statut SMALLINT DEFAULT 0 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO app_user (id, email, roles, password, numero_passeport, nom, prenom, date_naissance, lieu_naissance, nationalite, sexe, date_emission, date_expiration, pays_emission, telephone, adresse, ville, pays, code_postal, profession, situation_familiale, statut, created_at, updated_at) SELECT id, email, roles, password, numero_passeport, nom, prenom, date_naissance, lieu_naissance, nationalite, sexe, date_emission, date_expiration, pays_emission, telephone, adresse, ville, pays, code_postal, profession, situation_familiale, statut, created_at, updated_at FROM __temp__app_user');
        $this->addSql('DROP TABLE __temp__app_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EMAIL ON app_user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_PASSEPORT ON app_user (numero_passeport)');
    }
}
