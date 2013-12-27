SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `gm_system_db` ;
CREATE SCHEMA IF NOT EXISTS `gm_system_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `gm_system_db` ;

-- -----------------------------------------------------
-- Table `gm_system_db`.`system_permission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gm_system_db`.`system_permission` ;

CREATE TABLE IF NOT EXISTS `gm_system_db`.`system_permission` (
  `permission_level` INT NOT NULL,
  `permission_name` CHAR(16) NOT NULL,
  `permission_list` TEXT NOT NULL,
  PRIMARY KEY (`permission_level`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gm_system_db`.`system_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gm_system_db`.`system_user` ;

CREATE TABLE IF NOT EXISTS `gm_system_db`.`system_user` (
  `guid` BIGINT NOT NULL AUTO_INCREMENT,
  `user_name` CHAR(32) NOT NULL,
  `user_pass` CHAR(64) NOT NULL,
  `user_founder` TINYINT NOT NULL DEFAULT 0,
  `user_lastlogin` INT NOT NULL DEFAULT 0,
  `permission_level` INT NOT NULL,
  `permission_name` CHAR(16) NOT NULL,
  `user_fromwhere` CHAR(16) NOT NULL,
  `user_status` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`guid`))
ENGINE = InnoDB
AUTO_INCREMENT = 30016078101;


-- -----------------------------------------------------
-- Table `gm_system_db`.`system_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gm_system_db`.`system_log` ;

CREATE TABLE IF NOT EXISTS `gm_system_db`.`system_log` (
  `log_id` INT NOT NULL AUTO_INCREMENT,
  `log_action` VARCHAR(64) NOT NULL,
  `log_uri` VARCHAR(128) NOT NULL,
  `log_parameter` TEXT NOT NULL,
  `log_time` INT NOT NULL,
  `log_guid` BIGINT NOT NULL,
  `log_name` CHAR(16) NOT NULL,
  PRIMARY KEY (`log_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `gm_system_db`.`system_permission`
-- -----------------------------------------------------
START TRANSACTION;
USE `gm_system_db`;
INSERT INTO `gm_system_db`.`system_permission` (`permission_level`, `permission_name`, `permission_list`) VALUES (999, '超级管理员', 'All');

COMMIT;


-- -----------------------------------------------------
-- Data for table `gm_system_db`.`system_user`
-- -----------------------------------------------------
START TRANSACTION;
USE `gm_system_db`;
INSERT INTO `gm_system_db`.`system_user` (`guid`, `user_name`, `user_pass`, `user_founder`, `user_lastlogin`, `permission_level`, `permission_name`, `user_fromwhere`, `user_status`) VALUES (30016078101, 'johnnyeven', 'b40714d351a35e8f0d2f15ee977da4a9f5a7e2cd', 1, 0, 999, '超级管理员', 'default', 1);

COMMIT;

