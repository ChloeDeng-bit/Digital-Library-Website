# Digital-Library-Website

Welcome to the Digital Library Website repository! This web application provides digital access to a variety of library resources, including books, textbooks, and workbooks. It caters to two types of users: Librarians and Borrowers (regular users). Users can register, log in, and interact with the system to manage and access resources efficiently.

**User Authentication and Session Management**
The Digital Library Management System focuses on user authentication and session management to provide a secure and seamless experience.

User Registration
Register as Librarian or Borrower:
Users can register as Librarians or Borrowers.
Input format is verified to ensure accurate user information.
User Login
Log in securely:
Registered users can log in securely to access personalized features.
User information is verified during the login process.
Session Management
Persistent Sessions:
Sessions are maintained until the user logs out, ensuring a seamless user experience.
Persistent sessions enable users to navigate the system without repeated logins.

**Librarian and Borrower Functionalities**
Librarian Features
Librarians have access to functionalities that streamline resource management:

Insert Resource:

Add new resources to the system, providing details such as BookNo, ISBN, Title, Author, Publisher, Status, and cost per day.
View Resources:

Access a comprehensive list of all resources in the system.
Search for a Resource:

Perform searches based on ISBN, Title, Author, or Status. Users can enter partial search strings.
Change Resource Status:

Modify the status of a resource, indicating whether it is available or borrowed.
List Borrowed and Available Resources:

Generate lists of all borrowed and available resources.
Borrower Features
Borrowers can enjoy functionalities designed for efficient resource utilization:

List Available Resources:

View a list of all available resources in the system.
List Borrowed and Currently Borrowing Resources:

See a list of resources they have borrowed and those currently in their possession.
Search for a Resource:

Perform searches based on ISBN, Title, Author, or Status. Users can enter partial search strings.
Borrow a Resource:

Borrow resources, specifying the duration of the borrowing period.
Receive a notification with the return date and associated borrowing cost.

**Project Structure**
/Website:

Contains all web-related files and folders.
/Login and Register:
Files related to user registration and login functionalities.
/For Librarian:
Functionalities specific to Librarians.
/For Borrower:
Functionalities specific to Borrowers.
/Included Files:
Contains all included files for multiple uses.

/Database:
Contains files related to database setup and table creation.
/Scripts:
Code for building the database and tables.
### Note:
The physical structure of the project folders might differ from the logical structure described above. In reality, all code files may reside directly within the `/Website` folder.

Searching Resources
Both Librarians and Borrowers can search for resources using a combination of ISBN, Title, Author, or Status.
Partial search strings are supported, providing flexibility in searching for information.

**Getting Started**
To run the Digital Library Management System locally:

Clone this repository to your machine.
Set up the database with the necessary tables and relationships.
Navigate to /Database/Scripts and run the database setup script.
Configure the application settings.
Run the web application.
For detailed instructions, refer to the installation guide in the docs folder.

Contributors
Meiyun Deng
