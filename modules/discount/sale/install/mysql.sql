/* =-=-=-= Copyright © 2018 eMarket =-=-=-= 
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

DROP TABLE IF EXISTS emkt_modules_discount_sale;
CREATE TABLE emkt_modules_discount_sale (
	id int NOT NULL auto_increment,
        name varchar(256),
        language varchar(64),
        sale_value decimal(3,2),
	date_start datetime,
        date_end datetime,
	PRIMARY KEY (id, language))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;