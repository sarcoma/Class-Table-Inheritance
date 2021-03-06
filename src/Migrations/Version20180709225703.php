<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180709225703 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE archive (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, page_title TINYTEXT NOT NULL, meta_description TEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, archive_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, page_title TINYTEXT NOT NULL, meta_description TEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_23A0E662956195F (archive_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_abstract (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, order_number INT NOT NULL, section_type VARCHAR(255) NOT NULL, INDEX IDX_E55805FD7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_block (id INT NOT NULL, quote LONGTEXT NOT NULL, citation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, alt VARCHAR(255) NOT NULL, caption VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_block (id INT NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_block (id INT NOT NULL, image_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_945E138B3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E662956195F FOREIGN KEY (archive_id) REFERENCES archive (id)');
        $this->addSql('ALTER TABLE section_abstract ADD CONSTRAINT FK_E55805FD7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE quote_block ADD CONSTRAINT FK_8EE41A43BF396750 FOREIGN KEY (id) REFERENCES section_abstract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text_block ADD CONSTRAINT FK_D5AF2D7FBF396750 FOREIGN KEY (id) REFERENCES section_abstract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_block ADD CONSTRAINT FK_945E138B3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE image_block ADD CONSTRAINT FK_945E138BBF396750 FOREIGN KEY (id) REFERENCES section_abstract (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E662956195F');
        $this->addSql('ALTER TABLE section_abstract DROP FOREIGN KEY FK_E55805FD7294869C');
        $this->addSql('ALTER TABLE quote_block DROP FOREIGN KEY FK_8EE41A43BF396750');
        $this->addSql('ALTER TABLE text_block DROP FOREIGN KEY FK_D5AF2D7FBF396750');
        $this->addSql('ALTER TABLE image_block DROP FOREIGN KEY FK_945E138BBF396750');
        $this->addSql('ALTER TABLE image_block DROP FOREIGN KEY FK_945E138B3DA5256D');
        $this->addSql('DROP TABLE archive');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE section_abstract');
        $this->addSql('DROP TABLE quote_block');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE text_block');
        $this->addSql('DROP TABLE image_block');
    }
}
