CREATE DATABASE IF NOT EXISTS session_db COLLATE utf8_unicode_ci;

--
-- Create the user account
--
CREATE USER 'session_user'@localhost IDENTIFIED BY 'session_user_pass';
GRANT SELECT, INSERT ON session_db.* TO 'session_user'@localhost;

USE session_db;

DROP TABLE IF EXISTS session;

CREATE TABLE session (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `session_var_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `session_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `session_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='CURRENT_TIMESTAMP';

INSERT INTO `session` (`session_id`, `session_var_name`, `session_value`, `session_timestamp`) VALUES
('ehhc4h3r0j7r91tt3rjvt0pg58',	'user_name',	'freddy',	'2019-10-16 13:34:28'),
('ehhc4h3r0j7r91tt3rjvt0pg58',	'user_password',	'password',	'2019-10-16 13:34:28');

FLUSH PRIVILEGES;
