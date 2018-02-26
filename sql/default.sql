
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- palavra
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `palavra`;

CREATE TABLE `palavra`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `palavra` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `palavra_un_in` (`palavra`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- nome_sugerido
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `nome_sugerido`;

CREATE TABLE `nome_sugerido`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(250) NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `nome_un_in` (`nome`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
