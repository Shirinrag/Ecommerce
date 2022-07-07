ALTER TABLE `subcategory` ADD `fk_lang_id` INT NULL DEFAULT NULL AFTER `sub_category_id`;
ALTER TABLE `category` ADD `fk_lang_id` INT NULL DEFAULT NULL AFTER `category_id`;
ALTER TABLE `subcategory` CHANGE `sub_category_name_ar` `sub_category_name_ar` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
