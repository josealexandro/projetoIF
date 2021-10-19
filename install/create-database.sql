SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` ;
USE `biblioteca` ;


-- -----------------------------------------------------
-- Table `biblioteca`.`autoras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`autoras` (
  `cod_autora` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `biografia` TEXT NOT NULL,
  `foto` MEDIUMBLOB NULL,
  `data_nasc` DATE NOT NULL,
  `data_morte` DATE NULL,
  `instagram` VARCHAR(45) NULL,
  `facebook` VARCHAR(45) NULL,
  `twitter` VARCHAR(45) NULL,
  `site_autora` VARCHAR(100) NULL,
  PRIMARY KEY (`cod_autora`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`tipo_obra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`tipo_obra` (
  `cod_tipo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cod_tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`editora` (
  `cod_editora` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cidade` VARCHAR(50) NOT NULL,
  `estado` VARCHAR(2) NULL,
  `site_editora` VARCHAR(100) NULL,
  PRIMARY KEY (`cod_editora`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`obras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`obras` (
  `cod_obra` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(200) NOT NULL,
  `resumo` TEXT NOT NULL,
  `ano` INT NOT NULL,
  `capa` MEDIUMBLOB NULL,
  `url` VARCHAR(200) NULL,
  `autora_obra` INT NOT NULL,
  `tipo_obra` INT NOT NULL,
  `editora_obra` INT NOT NULL,
  PRIMARY KEY (`cod_obra`),
  INDEX `fk_obras_autoras_idx` (`autora_obra` ASC) VISIBLE,
  INDEX `fk_obras_tipo_obra1_idx` (`tipo_obra` ASC) VISIBLE,
  INDEX `fk_obras_editora1_idx` (`editora_obra` ASC) VISIBLE,
  CONSTRAINT `fk_obras_autoras`
    FOREIGN KEY (`autora_obra`)
    REFERENCES `biblioteca`.`autoras` (`cod_autora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_obras_tipo_obra1`
    FOREIGN KEY (`tipo_obra`)
    REFERENCES `biblioteca`.`tipo_obra` (`cod_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_obras_editora1`
    FOREIGN KEY (`editora_obra`)
    REFERENCES `biblioteca`.`editora` (`cod_editora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`perfil` (
  `cod_perfil` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cod_perfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`usuarios` (
  `cod_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `perfil_usuario` INT NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  INDEX `fk_usuarios_perfil1_idx` (`perfil_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_usuarios_perfil1`
    FOREIGN KEY (`perfil_usuario`)
    REFERENCES `biblioteca`.`perfil` (`cod_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;