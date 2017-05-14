# CMR - Car Maintenance Reminder

CMR is a simple WP plugin for garage owners(not only) that sending reminder mails to it's customers about car maintenance.

## Getting Started

Clone the repository

### Prerequisites

In order to use the plugin SMTP server shoul be started on your hosting.
If you wanto to try it on localhost(let's say XAMPP) you need to change:
	1) php.ini file:

		a. [mail function] section

			; For Win32 only.
			; http://php.net/smtp

			SMTP=smtp.gmail.com

			;localhost
			; http://php.net/smtp-port

			smtp_port=587
			;25

			; For Win32 only.
			; http://php.net/sendmail-from

			sendmail_from = user@gmail.com


	2)	sendemail.ini file:
		  a. smtp_server=smtp.gmail.com
		  	 smtp_port=587

		  b. auth_username=user@gmail.com	
			 auth_password=your_gmail_password

		  c. force_sender=user@gmail.com

sd