<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129171033 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(145) DEFAULT NULL, color VARCHAR(10) DEFAULT NULL, comment VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrance (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, ticket_id INT DEFAULT NULL, seat_id INT DEFAULT NULL, INDEX IDX_87DA61896BF700BD (status_id), INDEX IDX_87DA6189700047D2 (ticket_id), INDEX IDX_87DA6189C1DAFE35 (seat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(155) DEFAULT NULL, color VARCHAR(10) DEFAULT NULL, comment VARCHAR(454) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, ticket_id INT DEFAULT NULL, groups_id INT DEFAULT NULL, first_name VARCHAR(415) NOT NULL, last_name VARCHAR(455) NOT NULL, email VARCHAR(245) DEFAULT NULL, secret VARCHAR(245) DEFAULT NULL, comment VARCHAR(545) DEFAULT NULL, subg_id INT DEFAULT NULL, INDEX IDX_ACB79A35700047D2 (ticket_id), INDEX IDX_ACB79A35F373DCF (groups_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(145) NOT NULL, image VARCHAR(455) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE row (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(145) DEFAULT NULL, comment VARCHAR(345) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat (id INT AUTO_INCREMENT NOT NULL, sub_room_id INT DEFAULT NULL, row_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(145) NOT NULL, order_number BIGINT NOT NULL, comment VARCHAR(445) DEFAULT NULL, pos_x INT DEFAULT NULL, pos_y INT DEFAULT NULL, rotation INT DEFAULT NULL, locked SMALLINT DEFAULT NULL, INDEX IDX_3D5C36662BCF2C67 (sub_room_id), INDEX IDX_3D5C366683A269F2 (row_id), INDEX IDX_3D5C366612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(65) NOT NULL, comment VARCHAR(145) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_room (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, name VARCHAR(145) NOT NULL, INDEX IDX_5509CE5A54177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(145) DEFAULT NULL, comment VARCHAR(545) DEFAULT NULL, INDEX IDX_97A0ADA312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrance ADD CONSTRAINT FK_87DA61896BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE entrance ADD CONSTRAINT FK_87DA6189700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE entrance ADD CONSTRAINT FK_87DA6189C1DAFE35 FOREIGN KEY (seat_id) REFERENCES seat (id)');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A35700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A35F373DCF FOREIGN KEY (groups_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE seat ADD CONSTRAINT FK_3D5C36662BCF2C67 FOREIGN KEY (sub_room_id) REFERENCES sub_room (id)');
        $this->addSql('ALTER TABLE seat ADD CONSTRAINT FK_3D5C366683A269F2 FOREIGN KEY (row_id) REFERENCES row (id)');
        $this->addSql('ALTER TABLE seat ADD CONSTRAINT FK_3D5C366612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE sub_room ADD CONSTRAINT FK_5509CE5A54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE seat DROP FOREIGN KEY FK_3D5C366612469DE2');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA312469DE2');
        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_ACB79A35F373DCF');
        $this->addSql('ALTER TABLE sub_room DROP FOREIGN KEY FK_5509CE5A54177093');
        $this->addSql('ALTER TABLE seat DROP FOREIGN KEY FK_3D5C366683A269F2');
        $this->addSql('ALTER TABLE entrance DROP FOREIGN KEY FK_87DA6189C1DAFE35');
        $this->addSql('ALTER TABLE entrance DROP FOREIGN KEY FK_87DA61896BF700BD');
        $this->addSql('ALTER TABLE seat DROP FOREIGN KEY FK_3D5C36662BCF2C67');
        $this->addSql('ALTER TABLE entrance DROP FOREIGN KEY FK_87DA6189700047D2');
        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_ACB79A35700047D2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE entrance');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE row');
        $this->addSql('DROP TABLE seat');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE sub_room');
        $this->addSql('DROP TABLE ticket');
    }
}
