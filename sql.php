ALTER TABLE `facility` ADD `facility_new_name` VARCHAR(255) NOT NULL AFTER `facility_name`;
ALTER TABLE `facility` ADD `equipment_Specification_type` VARCHAR(255) NOT NULL AFTER `quantity`;