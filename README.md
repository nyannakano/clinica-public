This repository is from a job that I've done for the company I used to work on. The name of the company is Kuba Inteligência da Informação, and you can have more info/contact here: https://www.linkedin.com/company/kuba-intelig%C3%AAncia-da-informa%C3%A7%C3%A3o/

The project was coded for a local beauty clinic called Scullp. The system has the next functions:

- Register the professionals from the clinic
- Register clients
- Schedule appointments
- Make service orders, where you can register all the info and generate financial bills to receive, and generate a preset number of schedules at the same time (the way it works is a bit confusing, but everything is on the way the client asked for)
- The clients have the access to another session from the administrators, where they can sign up on the site, and make requests for schedules on an interactive calendar. This calendar shows only the available schedules for the professional chosen. When the client do the request, it pop-up on the administrator page, and then the clinic approves or disapproves the schedule. Also in every schedule, the administrators have access to a WhatsApp Button, to quickly contact the client.
- On the calendar, the administrators have the Confirm button, and then the schedule changes the icon for better identification. 

The system is in use by the clinic on the URL: http://scullp.kubainteligencia.com.br/
But I don't support it anymore since I'm no longer part of the company (Kuba Inteligência) anymore. The code presented here in the repo was done by me, everything else that has been added or removed on the production site was done by the current dev team of Kuba.

Some of the functions may not work properly because there were a lot of things we had to modify in the production system. Many things are caused by the shared hosting system.

Technologies used:

- PHP
- JavaScript (a bit of jQuery)
- Laravel
- FullCalendar (a calendar framework based on JavaScript)
- BootStrap
- MariaDB

To get it working:
You have to configure a .env and a MySQL database (or another database of your choice), in both .env and /config/database archive.
You have to create a symlink to the storage for the images work properly.
Run php artisan migrate.
Run php artisan db:seed.
