

# Webchama 

Our digital chama management system makes it enables one to create, join, and manage chamas. Track finances, communicate with members, and collaborate efficiently. 




## Installation

Install webchama with npm

[PHP ](https://www.php.net/downloads.php)

[Composer](https://getcomposer.org/download/)

[Laravel](https://laravel.com/docs/10.x/installation)

[MySQL ](https://dev.mysql.com/downloads/installer/)

[Node.js & npm ](https://nodejs.org/en/download/)

[Git](https://git-scm.com/downloads)

[Filament](https://filamentphp.com/)
## Run Locally

Clone the project

```bash
  git clone  https://github.com/MercyWangondu/webchama
```

Go to the project directory

```bash
  cd webchama
```

Install dependencies

```bash
  npm install
```

Start the server

```bash
  npm run start
```
## Used By

This project is used by the following companies:

- People already present in chamas and a looking for a way to continue to manage their chama but digitally
- People forming chamas from scratch and looking for a way to manage their chamas

## Features


- User registration and authentication
- Create and manage Chamas
- Join existing Chamas with a unique code
- Manage member roles and permissions
- Track contributions and financial records
- Generate financial reports
- Notifications and alerts for events and contributions
- Profile management with photo upload and crop functionality
- Change password with email verification
- Lock screen functionality
- Secure logout
- Light/dark mode toggle
- Live previews of data
- Fullscreen mode for enhanced viewing## API Reference

#### Get all items

```http
POST /api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. User's name  |
| `email` | `string` | **Required**. User's email  |
| `password` | `string` | **Required**.password  |
| `id_number` | `string` | **Required**.ID Number  |


```http
  POST /api/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**.User's email  |
| `password` | `string` | **Required**.User's password  |


```http
   Gets all chamas
   GET /api/chamas
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Your API key|

```http

   GET /api/chamas/${id}

```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. IDof chama to fetch|


## Roadmap
User Authentication
Implement user registration and login

Enable social media login integrations (e.g., Google, Facebook)

Chama Creation and Management

Implement member invitation and approval workflows

Enable contribution tracking and reporting
Integrate basic financial accounting features

Implement two-factor authentication (2FA)

Regular security audits and improvements

User Profile Enhancements

Add profile customization options

Enable profile picture upload and cropping

Communication Tools

Implement in-app messaging between members
Set up notification systems for important events (e.g., meetings, due payments)

Develop and release Android and iOS applications

Ensure synchronization with web application

Introduce budgeting tools and financial goal setting

Enable automated reminders for contributions and other financial commitments

Integration with Financial Services
Integrate with popular mobile money platforms (e.g., M-Pesa)

Enable direct bank integrations for seamless transactions

Develop advanced analytics for Chama activities

Provide downloadable reports in various formats (e.g., PDF, Excel)

Implement discussion forums for members

Enable resource sharing (e.g., documents, links)

Additional Browser Support
Ensure compatibility with all major browsers (e.g., Chrome, Firefox, Safari, Edge)



## Acknowledgements

 - [Awesome Readme Templates](https://awesomeopensource.com/project/elangosundar/awesome-README-templates)
 - [Dashboard Template](https://templatemo.com/tm-574-mexant)
 

## Documentation

- [Documentation](https://1drv.ms/w/c/7e09951e873dc495/Ed7OTHDcQFRHowZOTtvyT5ABlw1b6zLWbbJX6IdqRAFz1w?e=ig2Bnz)

## Running Tests

To run tests, run the following command

```bash
 php artisan serve



## File Tree Structure 


C:.
|
|
+---app
|   +---Filament
|   |   +---Pages
|   |   |   \---Tenancy
|   |   |           EditTeamProfile.php
|   |   |           RegisterTeam.php
|   |   |
|   |   +---Resources
|   |   |   |
|   |   |   +---ChamaResource
|   |   |   |
|   |   |   |
|   |   |   +---ContributionsResource
|   |   |   |
|   |   |   +---MembersResource
|   |   |   |
|   |   |   |
|   |   |   \---UserResource
|   |   |
|   |   |
|   |   +---Treasurer
|   |   |   +---Resources
|   |   |   |
|   |   |   \---Widgets
|   |   |
|   |   |
|   |   \---Widgets
|   |
|   +---Http
|   |   \---Controllers
|   |
|   +---Mail
|   |
|   +---Models
|   |
|   |
|   \---Providers
|       |   AppServiceProvider.php
|       |
|       \---Filament
|               AdminPanelProvider.php
|               TreasurerPanelProvider.php
|
+---bootstrap
|   |
|
+---config
|
|
+---database
|   +---factories
|   |
|   |
|   +---migrations
|   |
|   |
|   \---seeders
|
|
+---public
|   |
|   |
|   +---assets
|   |
|   |   +---images
|   |   |
|   |   |
|   |   +---js
|   |   |
|   |   \---webfonts
|   |
|   +---css
|   |   |
|   |
|   +---js
|   |
|   \---vendor
|
|       \---jquery
|
+---resources
|   +---css
|   |
|   |
|   +---js
|   |
|   |
|   +---sass
|   |
|   |
|   \---views
|       |
|       |
|       +---alert
|       |
|       |
|       +---auth
|       |   |
|       |   \---passwords
|       |
|       |
|       +---chamas
|       |
|       |
|       +---components
|       |
|       |
|       +---emails
|       |
|       +---frontend
|       |
|       |
|       +---layouts
|       |
|       |
|       \---profile
|
+---routes
|
|
+---storage
|   +---app
|   |
|   +---framework
|   |   |
|   |   +---cache
|   |   |
|   |   |
|   |   +---sessions
|   |   |
|   |   |
|   |   +---testing
|   |   |
|   |   \---views
|   |
|   |
|   \---logs
|
|
\---tests
    |
    +---Feature
    |

