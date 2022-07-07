ALTER TABLE `subcategory` ADD `fk_lang_id` INT NULL DEFAULT NULL AFTER `sub_category_id`;
ALTER TABLE `category` ADD `fk_lang_id` INT NULL DEFAULT NULL AFTER `category_id`;
ALTER TABLE `childcategory` ADD `fk_lang_id` INT NULL DEFAULT NULL AFTER `child_category_id`;
ALTER TABLE `subcategory` CHANGE `sub_category_name_ar` `sub_category_name_ar` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `childcategory` CHANGE `child_category_name` `child_category_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `product` ADD `fk_lang_id` INT NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE `product` CHANGE `product_name_ar` `product_name_ar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
