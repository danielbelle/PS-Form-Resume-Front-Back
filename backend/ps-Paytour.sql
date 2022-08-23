CREATE DATABASE IF NOT EXISTS `form_ps`;
USE `form_ps`;


CREATE TABLE `dados_pessoas`( 
`id` INT unsigned not null auto_increment primary key,
`nome` VARCHAR(40),
`email` VARCHAR(100),
`celular` VARCHAR(20),
`cargo` TEXT,
`escolaridade` VARCHAR(40),
`obs` TEXT,
`arquivo` VARCHAR(200),
`data_atual` DATETIME,
`ip` VARCHAR(20) 
);

DROP TABLE IF EXISTS dados_pessoas
