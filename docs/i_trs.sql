-- PTF TRS Module
USE ws_piratetoyfund;

-- Use for both Partners and Donors
CREATE TABLE `TRS_Organization`(
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` TEXT NOT NULL,
  `type` ENUM('partner', 'donor'),
  `phone` VARCHAR(14) NOT NULL,
  `email` TEXT NOT NULL,
  `street` TEXT NOT NULL,
  `city` TEXT NOT NULL,
  `state` CHAR(2) NOT NULL,
  `zip` VARCHAR(10) NOT NULL,
  `approved` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

-- Entity where commodities will be stored
CREATE TABLE `TRS_Warehouse`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL UNIQUE,
  `address` TEXT NOT NULL,
  PRIMARY KEY (`id`)
);

-- User-defined commodity categories
CREATE TABLE `TRS_CommodityCategory`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);

-- Type of commodity
CREATE TABLE `TRS_Commodity`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sku` VARCHAR(128) NOT NULL UNIQUE,
  `category` INT(11) UNSIGNED NOT NULL,
  `name` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `TRS_Commodity_ibfk_1` FOREIGN KEY (`category`) REFERENCES `TRS_CommodityCategory`(`id`) ON UPDATE CASCADE
);

-- Record of quantity of each commodity stored in warehouse
CREATE TABLE `TRS_Commodity_Warehouse`(
  `warehouse` INT(11) UNSIGNED NOT NULL,
  `commodity` INT(11) UNSIGNED NOT NULL,
  `quantity` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`warehouse`, `commodity`),
  CONSTRAINT `TRS_Commodity_Warehouse_ibfk_1` FOREIGN KEY (`warehouse`) REFERENCES `TRS_Warehouse`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `TRS_Commodity_Warehouse_ibfk_2` FOREIGN KEY (`commodity`) REFERENCES `TRS_Commodity`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Record of commodity acquisition at warehouse
CREATE TABLE `TRS_Acquisition`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization` INT(11) UNSIGNED NOT NULL,
  `receiveDate` DATE NOT NULL,
  `warehouse` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`),
  CONSTRAINT `TRS_Acquisition_ibfk_1` FOREIGN KEY (`organization`) REFERENCES `TRS_Organization`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `TRS_Acquisition_ibfk_2` FOREIGN KEY (`warehouse`) REFERENCES `TRS_Warehouse`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

-- quantity of commodity received during acquisition
CREATE TABLE `TRS_Acquisition_Commodity`(
  `acquisition` INT(11) UNSIGNED NOT NULL,
  `commodity` INT(11) UNSIGNED NOT NULL,
  `quantity` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`acquisition`, `commodity`),
  CONSTRAINT `TRS_Acquisition_Commodity_ibfk_1` FOREIGN KEY (`commodity`) REFERENCES `TRS_Commodity`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `TRS_Acquisition_Commodity_ibfk_2` FOREIGN KEY (`acquisition`) REFERENCES `TRS_Acquisition`(`id`) ON UPDATE CASCADE ON DELETE CASCADE

);

-- request for commodities
CREATE TABLE `TRS_Order`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization` INT(11) UNSIGNED NOT NULL,
  `requestDate` DATE NOT NULL,
  `dueDate` DATE NOT NULL,
  `ready` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `received` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `TRS_Order_ibfk_1` FOREIGN KEY (`organization`) REFERENCES `TRS_Organization`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

-- requested commodity categories in order
CREATE TABLE `TRS_Order_Category`(
  `order` INT(11) UNSIGNED NOT NULL,
  `category` INT(11) UNSIGNED NOT NULL,
  `quantity` INT(11) UNSIGNED NOT NULL,
  `notes` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY (`order`, `category`),
  CONSTRAINT `TRS_Order_Category_ibfk_1` FOREIGN KEY (`order`) REFERENCES `TRS_Order` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `TRS_Order_Category_ibfk_2` FOREIGN KEY (`category`) REFERENCES `TRS_CommodityCategory`(`id`) ON UPDATE CASCADE
);

-- Final record of what commodities were supplied, from where, and how many
CREATE TABLE `TRS_OrderItem`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order` INT(11) UNSIGNED NOT NULL,
  `quantity` INT(11) UNSIGNED NOT NULL,
  `commodity` INT(11) UNSIGNED NOT NULL,
  `warehouse` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `TRS_OrderItem_ibfk_1` FOREIGN KEY (`order`) REFERENCES `TRS_Order` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `TRS_OrderItem_ibfk_2` FOREIGN KEY (`commodity`) REFERENCES `TRS_Commodity`(`id`) ON UPDATE CASCADE,
  CONSTRAINT `TRS_OrderItem_ibfk_3` FOREIGN KEY (`warehouse`) REFERENCES `TRS_Warehouse`(`id`) ON UPDATE CASCADE
);

CREATE TABLE `TRS_Organization_Representative` (
  `organization` INT(11) UNSIGNED NOT NULL,
  `user` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `TRS_Organization_Representative_ibfk_1` FOREIGN KEY (`organization`) REFERENCES `TRS_Organization`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `TRS_Organization_Representative_ibfk_2` FOREIGN KEY (`user`) REFERENCES `User`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
  );

-- Permissions
INSERT INTO `Permission`(`code`) VALUES ('trs');
INSERT INTO `Permission`(`code`) VALUES ('trs_backoffice'), ('trs_repportal');
INSERT INTO `Permission`(`code`) VALUES ('trs_organizations-r'), ('trs_organizations-w');
INSERT INTO `Permission`(`code`) VALUES ('trs_commodities-r'), ('trs_commodities-w'), ('trs_commodities-a'), ('trs_warehouses-r'), ('trs_warehouses-w');