-- MySQL Script generated by MySQL Workbench
-- Tue Sep  8 18:00:02 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Cours
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Cours
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Cours` DEFAULT CHARACTER SET utf8 ;
USE `Cours` ;

-- -----------------------------------------------------
-- Table `Cours`.`establishment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`establishment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`semester`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`semester` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `semester` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`branch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`branch` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `abbreviated` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `abbreviated_UNIQUE` (`abbreviated` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`lineBranch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`lineBranch` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `establishment_id` INT NOT NULL,
  `branch_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_linebe_establishment1_idx` (`establishment_id` ASC) ,
  INDEX `fk_linebe_branch1_idx` (`branch_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `lastName` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `password` VARCHAR(250) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `activated` TINYINT NOT NULL DEFAULT 0,
  `registredAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` INT NOT NULL DEFAULT 1 COMMENT '0 for admin, 1 for user',
  `type` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'student' COMMENT 'student,professor, guest',
  `gender` INT NOT NULL COMMENT '0 for male, 1 for female',
  `establishment_id` INT NOT NULL DEFAULT 0,
  `semester_id` INT NOT NULL DEFAULT 0,
  `lineBranch_id` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  INDEX `fk_user_establishment1_idx` (`establishment_id` ASC) ,
  INDEX `fk_user_semester1_idx` (`semester_id` ASC) ,
  INDEX `fk_user_lineBranch1_idx` (`lineBranch_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`unity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`unity` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`module`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`module` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `branch_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_module_branch1_idx` (`branch_id` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`lineModule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`lineModule` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `unity_id` INT NOT NULL,
  `semester_id` INT NOT NULL,
  `module_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_lineLearn_unity1_idx` (`unity_id` ASC) ,
  INDEX `fk_lineLearn_semester1_idx` (`semester_id` ASC) ,
  INDEX `fk_lineLearn_module1_idx` (`module_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`file`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`file` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(500) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `uploadedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmed` TINYINT NOT NULL DEFAULT 1,
  `user_id` INT NOT NULL,
  `lineModule_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_file_user1_idx` (`user_id` ASC) ,
  INDEX `fk_file_lineModule1_idx` (`lineModule_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Cours`.`lineTeaching`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`lineTeaching` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `lineModule_id` INT NOT NULL,
  `establishment_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_linemu_user1_idx` (`user_id` ASC) ,
  INDEX `fk_linemu_lineModule1_idx` (`lineModule_id` ASC) ,
  INDEX `fk_lineTeaching_establishment1_idx` (`establishment_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

USE `Cours` ;

-- -----------------------------------------------------
-- Placeholder table for view `Cours`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`users` (`id` INT, `firstName` INT, `lastName` INT, `email` INT, `password` INT, `activated` INT, `registredAt` INT, `role` INT, `type` INT, `gender` INT, `establishment_id` INT, `semester_id` INT, `lineBranch_id` INT, `establishment` INT, `abbreviated` INT, `branch` INT, `semester` INT, `branch_id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `Cours`.`modules`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`modules` (`id` INT, `branch` INT, `abbreviated` INT, `module` INT, `unity` INT, `semester` INT, `branch_id` INT, `semester_id` INT, `unity_id` INT, `module_id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `Cours`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`files` (`id` INT, `path` INT, `uploadedAt` INT, `confirmed` INT, `user_id` INT, `lineModule_id` INT, `firstName` INT, `lastName` INT, `email` INT, `password` INT, `activated` INT, `registredAt` INT, `role` INT, `type` INT, `gender` INT, `branch` INT, `abbreviated` INT, `module` INT, `unity` INT, `semester` INT, `branch_id` INT, `semester_id` INT, `unity_id` INT, `module_id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `Cours`.`teachs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`teachs` (`id` INT, `user_id` INT, `lineModule_id` INT, `establishment_id` INT, `firstName` INT, `lastName` INT, `email` INT, `module` INT, `semester` INT, `unity` INT, `branch` INT);

-- -----------------------------------------------------
-- Placeholder table for view `Cours`.`modulesDetail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cours`.`modulesDetail` (`id` INT);

-- -----------------------------------------------------
-- View `Cours`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Cours`.`users`;
USE `Cours`;
CREATE  OR REPLACE VIEW `users` AS
SELECT u.*,e.name establishment,b.abbreviated,b.name branch, s.semester,lb.branch_id 
FROM establishment e,lineBranch lb,branch b, user u, semester s
WHERE e.id = lb.establishment_id and lb.branch_id = b.id and lb.id = u.lineBranch_id and s.id = u.semester_id and e.id = u.establishment_id and u.type = 'student'
union ALL
SELECT u.*,e.name establishment,'' abbreviated,'' branch, '' semester,0 branch_id
FROM user u, establishment e
WHERE e.id = u.establishment_id and u.type = 'professor'
union ALL
SELECT u.*,'' establishment,'' abbreviated,'' branch, '' semester,0 branch_id
FROM user u
WHERE u.type = 'guest';

-- -----------------------------------------------------
-- View `Cours`.`modules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Cours`.`modules`;
USE `Cours`;
CREATE  OR REPLACE VIEW `modules` AS
SELECT lm.id,b.name branch,b.abbreviated, m.name module,u.name unity,s.semester,m.branch_id,lm.semester_id, lm.unity_id,lm.module_id
FROM branch b, module m,lineModule lm,unity u,semester s 
WHERE b.id = m.branch_id and m.id = lm.module_id and s.id = lm.semester_id and u.id = lm.unity_id;

-- -----------------------------------------------------
-- View `Cours`.`files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Cours`.`files`;
USE `Cours`;
CREATE  OR REPLACE VIEW `files` AS
SELECT f.*, u.firstName, u.lastName, u.email, u.password, u.activated, u.registredAt, u.role,u.type, u.gender, m.branch, m.abbreviated, m.module, m.unity, m.semester, m.branch_id, m.semester_id, m.unity_id,m.module_id
FROM modules m, users u,file f 
WHERE m.id = f.lineModule_id and u.id = f.user_id;

-- -----------------------------------------------------
-- View `Cours`.`teachs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Cours`.`teachs`;
USE `Cours`;
CREATE  OR REPLACE VIEW `teachs` AS
SELECT lt.*,u.firstName,u.lastName,u.email,m.module,m.semester,m.unity,m.branch
FROM establishment e,users u, modules m,lineTeaching lt
WHERE e.id = u.establishment_id and e.id = lt.establishment_id and u.id = lt.user_id and m.id = lt.lineModule_id;

-- -----------------------------------------------------
-- View `Cours`.`modulesDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Cours`.`modulesDetail`;
USE `Cours`;
CREATE  OR REPLACE VIEW `modulesDetail` AS
SELECT m.*,t.user_id 
FROM (

    SELECT m.*,e.name establishment ,e.id establishment_id
    FROM `modules` m, establishment e,lineBranch lb 
    WHERE e.id = lb.establishment_id and lb.branch_id = m.branch_id
    
) m,teachs t 
WHERE m.establishment_id = t.establishment_id and m.id = t.lineModule_id

union all

SELECT *,0 user_id 
FROM (

    SELECT m.*,e.name establishment ,e.id establishment_id
    FROM `modules` m, establishment e,lineBranch lb 
    WHERE e.id = lb.establishment_id and lb.branch_id = m.branch_id
    
) m 
WHERE m.establishment_id not in (select establishment_id from teachs) or  m.id not in (select lineModule_id from teachs);
USE `Cours`;

DELIMITER $$
USE `Cours`$$
CREATE DEFINER = CURRENT_USER TRIGGER `Cours`.`user_AFTER_DELETE` AFTER DELETE ON `user` FOR EACH ROW
BEGIN
 DELETE FROM lineTeaching WHERE user_id = OLD.id;  
 DELETE FROM file WHERE user_id = OLD.id;  
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `Cours`.`establishment`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (1, 'Ly. My. Ismail MEKNES');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (2, 'Ly. Alaymoune Rabat');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (3, 'Ly. Technique Al Farabi Salé');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (4, 'Ly. Ibn Sina Kénitra');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (5, 'Ly. Pr. My. Abdellah Sidi Kacem');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (6, 'Ly. Al Khansa Casa Anfa');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (7, 'Ly. Al Khawarizmi Casa Al Fida');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (8, 'Ly. Technique Settat');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (9, 'Ly. Errazi El Jadida');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (10, 'Ly. Al Khawarizmi Safi');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (11, 'Ly. Technique Errachidia');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (12, 'Ly. Technique Fès');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (13, 'Ly. Technique Med V Béni Mellal');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (14, 'Ly. Hassan II Marrakech');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (15, 'Ly. Med VI Marrakech');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (16, 'Ly. Med V Essaouira');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (17, 'Ly. Tassaout Kalaa Sraghna');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (18, 'Ly. Technique Chichaoua');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (19, 'Ly. Idrissi Agadir Idaoutanane');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (20, 'Ly. Youssef Ben Tachfine Idaoutanane');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (21, 'Ly. Ibn El Haytam Ouarzazate');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (22, 'Ly. Massira Khadra Tiznit');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (23, 'Ly. Technique Guelmim');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (24, 'Ly. Lyssane Eddine Ibn Khatib Lâayoune');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (25, 'Ly. Imam Al Ghazali Tétouan');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (26, 'Ly. My. Youssef Tanger');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (27, 'Ly. Al Khawarizmi Chefchaouen');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (28, 'Ly. Maghreb Arabe Oujda');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (29, 'Ly. Mehdi Ben Berka Oujda');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (30, 'Ly. lalla khadija Dakhla');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (31, 'Ly. Al Badissi El Houceima');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (32, 'Ly. Ibn Sina Taounate');
INSERT INTO `Cours`.`establishment` (`id`, `name`) VALUES (33, 'Ly. Technique Taza');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`semester`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`semester` (`id`, `semester`) VALUES (DEFAULT, 1);
INSERT INTO `Cours`.`semester` (`id`, `semester`) VALUES (DEFAULT, 2);
INSERT INTO `Cours`.`semester` (`id`, `semester`) VALUES (DEFAULT, 3);
INSERT INTO `Cours`.`semester` (`id`, `semester`) VALUES (DEFAULT, 4);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`branch`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (1, 'DSI', 'Développement de sytèmes d\'information');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (2, 'Mouliste', 'Mouliste');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (3, 'Bâtiment', 'Bâtiment');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (4, 'Productique', 'Productique');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (5, 'Energétique', 'Energétique');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (6, 'ESA', 'Electromécanique et Systèmes Automatisés');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (7, 'MA', 'Maintenance Automobile');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (8, 'MI', 'Maintenance Industrielle');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (9, 'Electrotechnique', 'Electrotechnique');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (10, 'MPC', 'Matières Plastiques et Composites');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (11, 'CPI', 'Conception du Produit Industriel');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (12, 'SE', 'Systèmes Electroniques');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (13, 'SRI', 'Systèmes et Réseaux Informatiques');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (14, 'MCW', 'Multimédias et Conception WEB');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (15, 'GA', 'Gestion Administrative');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (16, 'CG', 'Comptabilité et Gestion');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (17, 'PME/PMI', 'Gestion des PME/PMI');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (18, 'MC', 'Management Commercial');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (19, 'MT', 'Management Touristique');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (20, 'TC', 'Technico-commercial');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (21, 'Audiovisuel', 'Audiovisuel');
INSERT INTO `Cours`.`branch` (`id`, `abbreviated`, `name`) VALUES (22, 'AIG', 'Arts et Industries Graphiques');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`lineBranch`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (1, 2, 22);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (2, 2, 21);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (3, 2, 3);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (4, 2, 15);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (5, 2, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (6, 3, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (7, 3, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (8, 3, 9);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (9, 4, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (10, 4, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (11, 4, 11);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (12, 4, 8);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (13, 5, 9);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (14, 5, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (15, 6, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (16, 6, 18);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (17, 6, 15);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (18, 7, 20);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (19, 7, 3);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (20, 7, 2);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (21, 7, 9);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (22, 7, 4);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (23, 7, 10);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (24, 7, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (25, 7, 6);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (26, 7, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (27, 8, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (28, 8, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (29, 8, 6);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (30, 8, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (31, 9, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (32, 9, 6);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (33, 9, 4);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (34, 9, 18);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (35, 10, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (36, 10, 11);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (37, 10, 20);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (38, 10, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (39, 1, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (40, 1, 7);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (41, 1, 4);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (42, 1, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (43, 11, 5);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (44, 11, 14);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (45, 11, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (46, 12, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (47, 12, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (48, 12, 20);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (49, 12, 19);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (50, 12, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (51, 13, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (52, 14, 3);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (53, 14, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (54, 15, 14);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (55, 15, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (56, 15, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (57, 16, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (58, 16, 19);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (59, 17, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (60, 18, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (61, 18, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (62, 19, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (63, 19, 6);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (64, 19, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (65, 19, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (66, 19, 11);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (67, 20, 4);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (68, 20, 19);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (69, 21, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (70, 21, 19);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (71, 22, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (72, 22, 18);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (73, 23, 19);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (74, 23, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (75, 24, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (76, 24, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (77, 25, 6);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (78, 25, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (79, 25, 4);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (80, 25, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (81, 26, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (82, 26, 18);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (83, 26, 12);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (84, 26, 11);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (85, 27, 19);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (86, 28, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (87, 28, 6);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (88, 28, 13);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (89, 28, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (90, 29, 9);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (91, 29, 11);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (92, 29, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (93, 30, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (94, 30, 17);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (95, 30, 19);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (96, 31, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (97, 32, 1);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (98, 32, 16);
INSERT INTO `Cours`.`lineBranch` (`id`, `establishment_id`, `branch_id`) VALUES (99, 33, 17);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`user` (`id`, `firstName`, `lastName`, `email`, `password`, `activated`, `registredAt`, `role`, `type`, `gender`, `establishment_id`, `semester_id`, `lineBranch_id`) VALUES (1, 'said', 'Hammane', 'said@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, DEFAULT, 0, 'student', 0, 1, 3, 39);
INSERT INTO `Cours`.`user` (`id`, `firstName`, `lastName`, `email`, `password`, `activated`, `registredAt`, `role`, `type`, `gender`, `establishment_id`, `semester_id`, `lineBranch_id`) VALUES (2, 'abdelkbir', 'Mahha', 'mahha@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, DEFAULT, 1, 'professor', 0, 1, 0, 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`unity`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (1, 'UE1 - ARCHITECTURE DES SYSTÈMES INFORMATIQUES');
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (2, 'UE2 - SYSTEMES D\'INFORMATION ET BASES DE DONNEES');
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (3, 'UE3 - CONDUITE DE PROJET INFORMATIQUE');
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (4, 'UE4 - DEVELOPPEMENT DES SYSTEMES D\'INFORMATION');
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (5, 'UE5 - PROJET DE FIN D’ETUDE ');
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (6, 'UE6 - ECONOMIE ET GESTION D’ENTREPRISES');
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (7, 'UE7 - LANGUES');
INSERT INTO `Cours`.`unity` (`id`, `name`) VALUES (8, 'UE8 - Mathématiques');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`module`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (1, 'M1 - Structure Technologie des composants des ordinateurs', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (2, 'M2 - Structure et Fonctionnement des ordinateurs', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (3, 'M3 - Programmation en langage assembleur', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (4, 'M4 - Systèmes d\'exploitation ', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (5, 'M5 - Réseaux informatiques', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (6, 'M6 - Conception des systèmes d’informations', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (7, 'M7 - Base de Données Relationnelle', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (8, 'M8 - Système de Gestion de Base de Données', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (9, 'M9 - Méthodes de conception orienté objet', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (10, 'M10 - Atelier de Génie logiciel', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (11, 'M11 - Gestion de projet', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (12, 'M12 - Assurance qualité, test et maintenance', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (13, 'M13 - Algorithmique et structures de données', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (14, 'M14 - Programmation procédurale', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (15, 'M15 - Programmation orientée objets Intégré', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (16, 'M16 - Environnement Développement Intégré ', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (17, 'M17 - Multimédia ', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (18, 'M18 - Développement WEB', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (19, 'M19 - Développement d’application client/serveur', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (20, 'M20 - Projet de fin d’étude', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (21, 'M21 - Logiciel de bureautique et communication', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (22, 'M22 - Techniques d’expression et de communication', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (23, 'M23 - Environnement Economique et Juridique de L’entreprise', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (24, 'M24 - Arabe ', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (25, 'M25 - Français', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (26, 'M26 - Anglais ', 1);
INSERT INTO `Cours`.`module` (`id`, `name`, `branch_id`) VALUES (27, 'M27 - Mathématiques', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`lineModule`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (1, 1, 1, 1);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (2, 1, 1, 2);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (3, 1, 2, 3);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (4, 1, 1, 4);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (5, 1, 2, 4);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (6, 1, 1, 5);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (7, 1, 2, 5);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (8, 2, 1, 6);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (9, 2, 2, 7);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (10, 2, 3, 8);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (11, 2, 4, 8);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (12, 3, 3, 9);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (13, 3, 4, 10);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (14, 3, 3, 11);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (15, 3, 4, 12);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (16, 4, 1, 13);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (17, 4, 2, 13);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (18, 4, 1, 14);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (19, 4, 2, 14);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (20, 4, 3, 15);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (21, 4, 4, 15);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (22, 4, 1, 16);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (23, 4, 2, 16);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (24, 4, 3, 16);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (25, 4, 4, 16);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (26, 4, 1, 17);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (27, 4, 2, 18);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (28, 4, 3, 18);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (29, 4, 4, 18);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (30, 4, 3, 19);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (31, 4, 4, 19);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (32, 5, 3, 20);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (33, 5, 4, 20);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (34, 6, 1, 21);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (35, 6, 1, 22);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (36, 6, 2, 22);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (37, 6, 3, 22);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (38, 6, 4, 22);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (39, 6, 1, 23);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (40, 6, 2, 23);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (41, 7, 1, 24);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (42, 7, 2, 24);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (43, 7, 3, 24);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (44, 7, 4, 24);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (45, 7, 1, 25);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (46, 7, 2, 25);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (47, 7, 3, 25);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (48, 7, 4, 25);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (49, 7, 1, 26);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (50, 7, 2, 26);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (51, 7, 3, 26);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (52, 7, 4, 26);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (53, 8, 1, 27);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (54, 8, 2, 27);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (55, 8, 3, 27);
INSERT INTO `Cours`.`lineModule` (`id`, `unity_id`, `semester_id`, `module_id`) VALUES (56, 8, 4, 27);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Cours`.`lineTeaching`
-- -----------------------------------------------------
START TRANSACTION;
USE `Cours`;
INSERT INTO `Cours`.`lineTeaching` (`id`, `user_id`, `lineModule_id`, `establishment_id`) VALUES (1, 2, 1, 1);
INSERT INTO `Cours`.`lineTeaching` (`id`, `user_id`, `lineModule_id`, `establishment_id`) VALUES (2, 2, 2, 1);
INSERT INTO `Cours`.`lineTeaching` (`id`, `user_id`, `lineModule_id`, `establishment_id`) VALUES (3, 2, 3, 1);

COMMIT;

