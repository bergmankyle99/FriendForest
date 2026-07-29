<h1 align="center">
  🌲 FriendForest
</h1>

<p align="center">
  A full-stack social media platform for connecting users, sharing posts, following friends, and communicating through private messaging.
</p>

<p align="center">
  Built with PHP, MySQL, JavaScript, AJAX, Bootstrap, Apache, and AWS.
</p>

---

# 🚀 Overview

FriendForest is a full-stack social networking application designed to allow users to create accounts, connect with other users, share content, and communicate through an interactive social platform.

The project focuses on implementing real-world web development concepts including:

- Full-stack application development
- User authentication
- Database design
- Server-side programming
- Client-server communication
- AJAX-powered interactions
- Cloud deployment

FriendForest provides users with a personalized social experience where they can create posts, follow other users, interact with content, send messages, and manage their profiles.

---

# ✨ Features

# 🔐 Authentication System

FriendForest includes a complete user authentication system.

Features:

- User registration
- User login
- Session-based authentication
- Logout functionality
- Account deletion

Users have their own personalized feed and protected account features.

---

# 📝 Post System

Users can create and interact with posts.

Features:

- Create posts
- View feed
- Search posts
- Like posts
- Comment on posts
- View liked posts
- View commented posts

Posts display:

- Username
- Post content
- Creation date
- Like count
- Comments

---

# 👥 Following System

FriendForest allows users to build connections with other users.

Features:

- Search for users
- Follow users
- View followers
- View following users
- Unfollow users

The following system allows users to create personalized feeds based on their connections.

---

# 💬 Messaging System

Users can communicate privately through direct messages.

Features:

- Send messages
- Receive messages
- View unread messages
- View previous messages
- Refresh message inbox

---

# 👤 Profile Management

Users can customize and update their profiles.

Features:

- Change username
- Update first name
- Update last name
- Update email
- Update bio
- Change password

---

# 🛠 Technology Stack

# Frontend

## HTML + CSS + JavaScript

Used for:

- User interface development
- Dynamic content updates
- Form handling
- User interactions

---

## Bootstrap

Used for:

- Responsive layouts
- UI components
- Buttons
- Modals
- Mobile compatibility

---

## jQuery + AJAX

Used for:

- Asynchronous requests
- Dynamic page updates
- Loading feeds without refreshes
- Messaging functionality
- User interactions

---

# Backend

## PHP

Used for:

- Server-side application logic
- Authentication
- Request handling
- Database communication
- Processing user actions

PHP handles functionality including:

- Creating posts
- Managing users
- Sending messages
- Updating profiles
- Following users

---

# Database

## MySQL

Stores application data including:

- User accounts
- Posts
- Comments
- Likes
- Followers
- Messages

Database concepts implemented:

- Relational database design
- Primary keys
- Foreign keys
- User relationships
- Persistent data storage

---

# 🏗 Architecture

```
                         User
                           |
                           |
                    Web Browser
                           |
                           |
                    Apache Server
                           |
                           |
                         PHP
                           |
              -------------------------
              |                       |
           MySQL                  JavaScript
              |                       |
       Application Data          AJAX Requests

```

---

# ☁️ Deployment

FriendForest is deployed using AWS infrastructure.

Deployment includes:

- AWS EC2
- Apache Web Server
- PHP Runtime
- MySQL Database
- Linux Server Environment

Application flow:

```
Browser

   |

Apache Web Server

   |

PHP Application

   |

MySQL Database
```

---

# 🔌 Application Flow

## Authentication Flow

```
User Registration

        |

Database Storage

        |

User Login

        |

Session Creation

        |

Application Access
```

---

## Post Creation Flow

```
User Creates Post

        |

AJAX Request

        |

PHP Backend

        |

MySQL Insert

        |

Updated Feed
```

---

## Messaging Flow

```
User Sends Message

        |

AJAX Request

        |

PHP Processing

        |

Database Storage

        |

Recipient Inbox
```

---

# 💻 Running Locally

## Requirements

Install:

- Apache
- PHP 8+
- MySQL
- Web Browser

---

# Clone Repository

```bash
git clone https://github.com/bergmankyle99/FriendForest.git

cd FriendForest
```

---

# Database Setup

Create the database:

```sql
CREATE DATABASE FriendForest;
```

Import the database:

```bash
mysql -u username -p < friendforest.sql
```

---

# Database Configuration

Update your database connection settings:

```php
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "FriendForest";
```

---

# Start Application

Place the project inside your Apache web directory.

Example:

```
/var/www/html/FriendForest
```

Open:

```
http://localhost/FriendForest
```

---

# 📚 Skills Demonstrated

FriendForest demonstrates experience with:

- Full-stack web development
- PHP backend development
- MySQL database architecture
- AJAX communication
- Authentication systems
- Session management
- Responsive UI development
- Cloud deployment
- Linux server administration

---

# 🔮 Future Improvements

Potential improvements:

- React frontend migration
- REST API backend
- Real-time messaging with WebSockets
- Image uploads
- Notifications
- Friend request system
- Improved search functionality
- Enhanced UI/UX
- Mobile application support

---

# 🎯 Project Purpose

FriendForest was created to explore the development of a complete social networking platform while applying practical software engineering principles.

This project demonstrates the ability to design and build a complete application including:

- Frontend interfaces
- Backend logic
- Database architecture
- User authentication
- Deployment infrastructure

FriendForest combines traditional web development technologies with modern application design practices to create a complete social media experience.
