<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180619150726 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avis_membre (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, note_membre INT NOT NULL, commentaire_membre LONGTEXT NOT NULL, date_commentaire_membre DATETIME NOT NULL, INDEX IDX_417E6F93EAAC4B6D (id_membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis_salle (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, id_salle_id INT NOT NULL, note_salle INT NOT NULL, commentaire_salle LONGTEXT NOT NULL, date_commentaire_salle DATETIME NOT NULL, INDEX IDX_395FFF22EAAC4B6D (id_membre_id), INDEX IDX_395FFF228CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_salle (id INT AUTO_INCREMENT NOT NULL, libelle_categorie_salle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, libelle_equipement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, id_salle_id INT NOT NULL, INDEX IDX_8933C432EAAC4B6D (id_membre_id), INDEX IDX_8933C4328CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indisponible (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, id_membre_id INT NOT NULL, jour_indisponible DATETIME NOT NULL, statut_indisponible INT NOT NULL, INDEX IDX_CBA9A7D8CEBACA0 (id_salle_id), INDEX IDX_CBA9A7DEAAC4B6D (id_membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, id_statut_membre_id INT NOT NULL, nom_membre VARCHAR(255) NOT NULL, prenom_membre VARCHAR(255) NOT NULL, nom_de_societe_membre VARCHAR(255) NOT NULL, siret_membre VARCHAR(255) NOT NULL, tva_membre VARCHAR(255) NOT NULL, date_de_naissance DATETIME NOT NULL, sexe_membre VARCHAR(255) NOT NULL, adresse_membre VARCHAR(255) NOT NULL, cp_membre VARCHAR(5) NOT NULL, ville_membre VARCHAR(255) NOT NULL, telephone_membre VARCHAR(13) NOT NULL, email_membre VARCHAR(255) NOT NULL, password_membre VARCHAR(255) NOT NULL, date_enregistrement_membre DATETIME NOT NULL, info_bancaire_membre VARCHAR(255) NOT NULL, photo_membre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F6B4FB2928BD3759 (id_statut_membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, lien_photo_default VARCHAR(255) NOT NULL, lien_photo_details VARCHAR(255) NOT NULL, INDEX IDX_14B784188CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, id_salle_id INT NOT NULL, etat_produit INT NOT NULL, message_produit LONGTEXT NOT NULL, INDEX IDX_29A5EC27EAAC4B6D (id_membre_id), INDEX IDX_29A5EC278CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_indisponible (produit_id INT NOT NULL, indisponible_id INT NOT NULL, INDEX IDX_E611C500F347EFB (produit_id), INDEX IDX_E611C5009A72063D (indisponible_id), PRIMARY KEY(produit_id, indisponible_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, id_categorie_salle_id INT NOT NULL, reference_salle VARCHAR(30) NOT NULL, nom_salle VARCHAR(255) NOT NULL, adresse_salle VARCHAR(255) NOT NULL, cp_salle VARCHAR(5) NOT NULL, ville_salle VARCHAR(255) NOT NULL, surface_salle INT NOT NULL, description_salle LONGTEXT NOT NULL, nbr_piece_salle INT NOT NULL, capacite_salle INT NOT NULL, prix_salle INT NOT NULL, equipement_salle INT NOT NULL, INDEX IDX_4E977E5CEAAC4B6D (id_membre_id), INDEX IDX_4E977E5C6795B3F0 (id_categorie_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_membre (id INT AUTO_INCREMENT NOT NULL, libelle_statut_membre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_membre ADD CONSTRAINT FK_417E6F93EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE avis_salle ADD CONSTRAINT FK_395FFF22EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE avis_salle ADD CONSTRAINT FK_395FFF228CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4328CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE indisponible ADD CONSTRAINT FK_CBA9A7D8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE indisponible ADD CONSTRAINT FK_CBA9A7DEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2928BD3759 FOREIGN KEY (id_statut_membre_id) REFERENCES statut_membre (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC278CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE produit_indisponible ADD CONSTRAINT FK_E611C500F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_indisponible ADD CONSTRAINT FK_E611C5009A72063D FOREIGN KEY (indisponible_id) REFERENCES indisponible (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5CEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C6795B3F0 FOREIGN KEY (id_categorie_salle_id) REFERENCES categorie_salle (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C6795B3F0');
        $this->addSql('ALTER TABLE produit_indisponible DROP FOREIGN KEY FK_E611C5009A72063D');
        $this->addSql('ALTER TABLE avis_membre DROP FOREIGN KEY FK_417E6F93EAAC4B6D');
        $this->addSql('ALTER TABLE avis_salle DROP FOREIGN KEY FK_395FFF22EAAC4B6D');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432EAAC4B6D');
        $this->addSql('ALTER TABLE indisponible DROP FOREIGN KEY FK_CBA9A7DEAAC4B6D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27EAAC4B6D');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5CEAAC4B6D');
        $this->addSql('ALTER TABLE produit_indisponible DROP FOREIGN KEY FK_E611C500F347EFB');
        $this->addSql('ALTER TABLE avis_salle DROP FOREIGN KEY FK_395FFF228CEBACA0');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4328CEBACA0');
        $this->addSql('ALTER TABLE indisponible DROP FOREIGN KEY FK_CBA9A7D8CEBACA0');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188CEBACA0');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC278CEBACA0');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2928BD3759');
        $this->addSql('DROP TABLE avis_membre');
        $this->addSql('DROP TABLE avis_salle');
        $this->addSql('DROP TABLE categorie_salle');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE indisponible');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_indisponible');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE statut_membre');
    }
}
