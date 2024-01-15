Telemetry Data Processing - Secure Web-Application Development
Installation and Execution Instructions :
1. Place the 'Telemetry' folder into your 'includes' directory. 2. Place the 'ctec3110' folder into your 'public_php' directory must have the lab_07 name all folders must be there. 3. Edit lines in TelemetryAttemptModel file in the 'src' folder to include your username and password of an EE M2M server account. 4. Execute the 'telemetrydatabase' SQL script in the MariaDB console to create the database.

Welcome to the Circuit board logger.

This application allows you to submit messages containing information for a circuit board. Messages can be sent via the web application or a valid phone number. All messages, along with its relevant meta-data can be viewed within the web application. This project was created as a part of the secure web application development course with De Montfort university. Meta-data shall be shown on the application pages.

How to use the program:
1. Go to the web application page using a valid browser
2. Use a valid name, email address and password to create your account cannot have null values to make an account or else redirected to page saying error
3. Log into the application using the information previously entered will take user to download message page wrong details will inform user if username is non existing or if password is wrong
4. download message page uses ee m2m webservice to allow user to message ee m2m server and then download xml string parse it and store it in database as well
as displaying message contents in relation to circuit board if the message has no circuit board data it can be seen and user has to view it on next page Telemetry details
or send message on send message pae
6. Telemetry details page shows the users message details such as sourcemsisdn messageberear etc
7. send message page allows user to select radio buttons and type in numbers to allow user to send back detail on the circuit board to desired phone number typed by user
Credits for application: Salah Sheikhmuse, Latisha Sonsri, Olivia Yates
