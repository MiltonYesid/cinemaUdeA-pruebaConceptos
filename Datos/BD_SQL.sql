
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES'; 
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ; 
USE `mydb` ; 
-- ----------------------------------------------------- 
-- Table `mydb`.`Sala` 
-- ----------------------------------------------------- 
CREATE  TABLE IF NOT EXISTS `mydb`.`Sala` ( 
  `Genero` VARCHAR(45) NOT NULL , 
  `Capacidad` INT NOT NULL DEFAULT 40 , 
  `Costo_Boleta` INT NOT NULL DEFAULT 0 , 
  `Ubicacion` VARCHAR(45) NOT NULL , 
  PRIMARY KEY (`Genero`) ) 
ENGINE = InnoDB; 
 
-- ----------------------------------------------------- 
-- Table `mydb`.`Pelicula` 
-- ----------------------------------------------------- 
CREATE  TABLE IF NOT EXISTS `mydb`.`Pelicula` ( 
  `Nombre` VARCHAR(45) NOT NULL , 
  `Director` VARCHAR(45) NOT NULL , 
  `Hora_Inicio` VARCHAR(45) NOT NULL , 
  `Hora_salida` VARCHAR(45) NOT NULL , 
  `Fecha` VARCHAR(45) NOT NULL , 
  `Id` INT ZEROFILL NOT NULL , 
  `Sala_Genero` VARCHAR(45) NOT NULL , 
  PRIMARY KEY (`Nombre`, `Hora_Inicio`, `Hora_salida`, `Fecha`, `Id`, `Sala_Genero`) , 
  INDEX `fk_Pelicula_Sala_idx` (`Sala_Genero` ASC) , 
  CONSTRAINT `fk_Pelicula_Sala` 
    FOREIGN KEY (`Sala_Genero` ) 
    REFERENCES `mydb`.`Sala` (`Genero` ) 
    ON DELETE NO ACTION 
    ON UPDATE NO ACTION) 
ENGINE = InnoDB; 
-- ----------------------------------------------------- 
-- Table `mydb`.`Boleta` 
-- ----------------------------------------------------- 
CREATE  TABLE IF NOT EXISTS `mydb`.`Boleta` ( 
  `Fila` INT NOT NULL , 
  `Columna` INT NOT NULL , 
  `Silla` INT NOT NULL , 
  `Valor` INT NOT NULL , 
  `Tipo` VARCHAR(45) NOT NULL DEFAULT 'GENERAL' , 
  `Pelicula_Nombre` VARCHAR(45) NOT NULL , 
  `Pelicula_Hora_Inicio` VARCHAR(45) NOT NULL , 
  `Pelicula_Hora_salida` VARCHAR(45) NOT NULL , 
  `Pelicula_Fecha` VARCHAR(45) NOT NULL , 
  `Pelicula_Id` INT ZEROFILL NOT NULL , 
  `Pelicula_Sala_Genero` VARCHAR(45) NOT NULL , 
  `Nmbre_Cliente` VARCHAR(45) NULL , 
  PRIMARY KEY (`Fila`, `Columna`, `Silla`, `Pelicula_Nombre`, `Pelicula_Hora_Inicio`, `Pelicula_Hora_salida`, `Pelicula_Fecha`, `Pelicula_Id`, `Pelicula_Sala_Genero`) , 
  INDEX `fk_Boleta_Pelicula1_idx` (`Pelicula_Nombre` ASC, `Pelicula_Hora_Inicio` ASC, `Pelicula_Hora_salida` ASC, `Pelicula_Fecha` ASC, `Pelicula_Id` ASC, `Pelicula_Sala_Genero` ASC) , 
  CONSTRAINT `fk_Boleta_Pelicula1` 
    FOREIGN KEY (`Pelicula_Nombre` , `Pelicula_Hora_Inicio` , `Pelicula_Hora_salida` , `Pelicula_Fecha` , `Pelicula_Id` , `Pelicula_Sala_Genero` ) 
    REFERENCES `mydb`.`Pelicula` (`Nombre` , `Hora_Inicio` , `Hora_salida` , `Fecha` , `Id` , `Sala_Genero` ) 
    ON DELETE NO ACTION 
    ON UPDATE NO ACTION) 
ENGINE = InnoDB; 
 
 
-- ----------------------------------------------------- 
-- Table `mydb`.`Politica_Negocio` 
-- ----------------------------------------------------- 
CREATE  TABLE IF NOT EXISTS `mydb`.`Politica_Negocio` ( 
  `Porcentaje_adicional_PREFERENCIAL` DOUBLE NOT NULL DEFAULT 0.20 , 
  `Fecha_Modificacion` DATETIME NOT NULL , 
  `Capacidad_general` DOUBLE NOT NULL DEFAULT 0.90 , 
  `Capacidad_preferencial` DOUBLE NOT NULL DEFAULT 0.10 , 
  `Admin` INT NOT NULL AUTO_INCREMENT , 
  PRIMARY KEY (`Admin`, `Fecha_Modificacion`) ) 
ENGINE = InnoDB; 
 
 
 
SET SQL_MODE=@OLD_SQL_MODE; 
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS; 
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS; 

