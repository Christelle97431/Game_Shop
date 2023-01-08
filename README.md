# Game_Shop

After 1 month of immersion in PHP, this 2 weeks project and first project with PHP is a simple e-commerce of board games (without the order part) which allows the management : 
- users (signup, login, update, logout)
- administrator (management of its dashboard to display the users, to modify the user to pass as administrator, to manage the articles: CRUD)  

The project is not finalized (absence of the token, graphical interface of some pages).  
A base for those who want to try to improve it.  
The code is written in PHP Vanilla, with tailwindscss. The database is made on MySQL.  


# Technologies  
* <img src="https://www.wampserver.com/wp-content/themes/wampserver/img/logo.png" width="150" alt="WampServer Logo">[WampServer](https://www.wampserver.com/) : Version 3.2
* <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT15d13IJ7gtixCZJXH-N-EctmRjvZyI8yw6BcbTX7A-g&s" width="60" alt="MySQL Logo">[MySQL](https://upload.wikimedia.org/wikipedia/commons/0/0a/MySQL_textlogo.svg) : Version 5.7 +
* <img src="https://cdn.tealfeed.com/articles/content-images/62f4025dde3f9a8b1dedc06f/1660158733560.jpeg" width="100" alt="Tailwindcss Logo">[Tailwindscss](https://tailwindcss.com/)


# Installation

1. WARNING !
Requires prior installation of WampServer with Apache, PHP and MySQL (Windows version)  
[WampServer](https://www.wampserver.com/)

2. Clone the project in the directory
`c:\wamp\www`

3. Run WampServer  

4. On the navigation page, type
`localhost`
The WampServer home page is displayed  

5. Click on phpMyAdmin
Enter your login and password. By default under windows : 
login : "root
password : ""
The MySQL home page is opened  

6. Import the my-shop.sql database

7. Open a 2nd navigation page and type : 
`http://localhost/Game_Shop/src`
You arrive on the home page of the project.   

# Access to the various pages  
1. Homeview : 
`http://localhost/Game_Shop/src`  
2. Login : 
`http://localhost/Game_Shop/signin`  
3. Register : 
`http://localhost/Game_Shop/signup`  
4. Dashboard Admin : 
`http://localhost/Game_Shop/admin`

# License
This application is open-source under the [MIT license](https://opensource.org/licenses/MIT). 

