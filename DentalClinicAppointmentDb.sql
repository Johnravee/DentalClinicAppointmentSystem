CREATE TABLE `messages`(
    `message_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `customer_ID` INT NOT NULL,
    `from` VARCHAR(255) NOT NULL,
    `message` VARCHAR(255) NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `date_time` DATETIME NOT NULL
);
CREATE TABLE `appoinments`(
    `appointment_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `customer_ID` INT NOT NULL,
    `Date` DATE NOT NULL,
    `Time` TIME NOT NULL,
    `Consultant` VARCHAR(255) NOT NULL,
    `transactionNumber` VARCHAR(255) NOT NULL,
    `Status` VARCHAR(255) NOT NULL,
    `appointmentType` VARCHAR(255) NOT NULL
);
CREATE TABLE `useraccounts`(
    `profile_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `profileImage` BLOB NULL,
    `email` VARCHAR(255) NOT NULL,
    `firstName` VARCHAR(255) NOT NULL,
    `middleName` VARCHAR(255) NOT NULL,
    `surName` VARCHAR(255) NOT NULL,
    `contact` VARCHAR(255) NOT NULL,
    `birthDate` VARCHAR(255) NOT NULL,
    `gender` VARCHAR(255) NULL,
    `address` VARCHAR(255) NULL,
    `passwords` VARCHAR(255) NOT NULL,
    `account_type` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `useraccounts` ADD UNIQUE `useraccounts_email_unique`(`email`);
CREATE TABLE `adminaccounts`(
    `adProfile_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `profileImage` BLOB NULL,
    `firstName` VARCHAR(255) NOT NULL,
    `middleName` VARCHAR(255) NOT NULL,
    `surName` VARCHAR(255) NOT NULL,
    `contact` VARCHAR(255) NOT NULL,
    `birthDate` DATE NOT NULL,
    `gender` VARCHAR(255) NOT NULL,
    `employeeID` VARCHAR(255) NOT NULL,
    `passwords` CHAR(255) NOT NULL
);
ALTER TABLE
    `adminaccounts` ADD UNIQUE `adminaccounts_email_unique`(`email`);
ALTER TABLE
    `adminaccounts` ADD UNIQUE `adminaccounts_employeeid_unique`(`employeeID`);
ALTER TABLE
    `appoinments` ADD CONSTRAINT `appoinments_customer_id_foreign` FOREIGN KEY(`customer_ID`) REFERENCES `useraccounts`(`profile_ID`);
ALTER TABLE
    `messages` ADD CONSTRAINT `messages_customer_id_foreign` FOREIGN KEY(`customer_ID`) REFERENCES `useraccounts`(`profile_ID`);