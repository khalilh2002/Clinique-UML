
/*khalil important -----------------------------------------*/



ALTER TABLE `employee` DROP FOREIGN KEY `categorie_fk`;

-- Add a new foreign key constraint with ON DELETE CASCADE
ALTER TABLE `employee`
  ADD CONSTRAINT `categorie_fk`
  FOREIGN KEY (`id_categorie`)
  REFERENCES `categorie` (`id_categorie`)
  ON DELETE CASCADE;




ALTER TABLE `docteur` DROP FOREIGN KEY `employee_fk_3`;

-- Add a new foreign key constraint with ON DELETE CASCADE
ALTER TABLE `docteur`
  ADD CONSTRAINT `employee_fk_3`
  FOREIGN KEY (`id_employee`)
  REFERENCES `employee` (`id_employee`)
  ON DELETE CASCADE;


ALTER TABLE `infermiere` DROP FOREIGN KEY `employee_fk_2`;

-- Add a new foreign key constraint with ON DELETE CASCADE
ALTER TABLE `infermiere`
  ADD CONSTRAINT `employee_fk_2`
  FOREIGN KEY (`id_employee`)
  REFERENCES `employee` (`id_employee`)
  ON DELETE CASCADE;