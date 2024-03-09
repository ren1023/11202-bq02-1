CREATE TABLE `bq0201`.`users` 
(`id` INT NOT NULL AUTO_INCREMENT , 
`acc` TEXT NULL DEFAULT NULL , 
`pw` TEXT NULL DEFAULT NULL , 
`email` TEXT NULL DEFAULT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `bq0201`.`total` 
(`id` INT NOT NULL AUTO_INCREMENT , 
`total` INT NULL DEFAULT NULL , 
`date` DATE NULL DEFAULT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `bq0201`.`news` 
(`id` INT NOT NULL AUTO_INCREMENT , 
`title` TEXT NOT NULL , 
`news` TEXT NOT NULL , 
`sh` INT(2) NOT NULL ,
`good` INT(2) NOT NULL , 
`type` INT(2) NOT NULL , 
 PRIMARY KEY (`id`)) ENGINE = InnoDB;


 帳號,密碼,電子郵件地址
admin,1234,admin@labor.gov.tw
test,5678,test@labor.gov.tw
mem01,mem01,mem01@labor.gov.tw
mem02,mem02,mem02@labor.gov.tw


INSERT INTO `users` 
(`id`, `acc`, `pw`, `email`) VALUES 
(NULL, 'admin', '1234', 'admin@labor.gov.tw'),
(NULL, 'test', '5678', 'test@labor.gov.tw'),
(NULL, 'mem01', 'mem01', 'mem01@labor.gov.tw'),
(NULL, 'mem02', 'mem02', 'mem02@labor.gov.tw');