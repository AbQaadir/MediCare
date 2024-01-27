-- Super Admin Table only one row

CREATE TABLE superAdmin (
    id INT PRIMARY KEY,
    email VARCHAR(255),
    pwd VARCHAR(255)
);

ALTER TABLE superAdmin
ADD CONSTRAINT UniqueSingleRow UNIQUE (id);

-- Step 3: Create a BEFORE INSERT trigger to enforce one-row limit
DELIMITER //
CREATE TRIGGER PreventInsert
BEFORE INSERT ON superAdmin
FOR EACH ROW
BEGIN
    DECLARE row_count INT;
    SELECT COUNT(*) INTO row_count FROM superAdmin;
    IF row_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Only one row is allowed in superAdmin.';
    END IF;
END;
//
DELIMITER ;


INSERT INTO superAdmin (id, email, pwd)
VALUES (1, 'superadmin@example.com', '1234');

