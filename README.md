<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FriendForest - Full Stack Social Media Platform</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f5;
            color: #222;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 40px;
        }

        h1 {
            font-size: 42px;
            color: #2f7d4f;
            margin-bottom: 5px;
        }

        h2 {
            color: #2f7d4f;
            border-bottom: 2px solid #5da27e;
            padding-bottom: 8px;
            margin-top: 40px;
        }

        h3 {
            color: #3d6b4d;
        }

        .subtitle {
            font-size: 20px;
            color: #555;
        }

        .badge {
            display: inline-block;
            background: #5da27e;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            margin: 5px;
            font-size: 14px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #f8faf8;
            border-left: 5px solid #5da27e;
            padding: 20px;
            border-radius: 8px;
        }

        .tech {
            margin-top: 15px;
        }

        code {
            background: #eee;
            padding: 3px 6px;
            border-radius: 5px;
        }

        .architecture {
            background: #1e1e1e;
            color: #eee;
            padding: 20px;
            border-radius: 8px;
            font-family: monospace;
        }

        ul {
            padding-left: 25px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            color: #777;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>FriendForest</h1>

    <p class="subtitle">
        A full-stack social media platform built from scratch that allows users
        to connect with friends, share posts, interact through likes and comments,
        send messages, and manage their profiles.
    </p>


    <div>
        <span class="badge">PHP</span>
        <span class="badge">MySQL</span>
        <span class="badge">JavaScript</span>
        <span class="badge">jQuery</span>
        <span class="badge">Bootstrap</span>
        <span class="badge">AJAX</span>
    </div>


    <h2>Overview</h2>

    <p>
        FriendForest was developed as a full-stack web application to explore
        real-world software development concepts including authentication,
        relational database design, server-side programming, dynamic frontend
        updates, and user interaction systems.
    </p>

    <p>
        The application provides a complete social networking experience where
        users can create posts, follow other users, comment, like content,
        exchange messages, and customize their profiles.
    </p>


    <h2>Features</h2>


    <div class="feature-grid">

        <div class="card">
            <h3>User Authentication</h3>
            <ul>
                <li>User registration and login</li>
                <li>Session-based authentication</li>
                <li>Secure account management</li>
            </ul>
        </div>


        <div class="card">
            <h3>Social Feed</h3>
            <ul>
                <li>Create posts</li>
                <li>View user content</li>
                <li>Search posts dynamically</li>
                <li>AJAX-powered updates</li>
            </ul>
        </div>


        <div class="card">
            <h3>User Connections</h3>
            <ul>
                <li>Follow and unfollow users</li>
                <li>View followers</li>
                <li>Discover users</li>
            </ul>
        </div>


        <div class="card">
            <h3>Interactions</h3>
            <ul>
                <li>Like posts</li>
                <li>Comment on posts</li>
                <li>View liked content</li>
            </ul>
        </div>


        <div class="card">
            <h3>Messaging</h3>
            <ul>
                <li>Send direct messages</li>
                <li>View unread messages</li>
                <li>Track message history</li>
            </ul>
        </div>


        <div class="card">
            <h3>Profiles</h3>
            <ul>
                <li>Edit personal information</li>
                <li>Update password/email</li>
                <li>Manage user bio</li>
            </ul>
        </div>

    </div>



    <h2>Technology Stack</h2>

    <h3>Frontend</h3>

    <ul>
        <li>HTML5</li>
        <li>CSS3</li>
        <li>JavaScript</li>
        <li>jQuery</li>
        <li>Bootstrap</li>
    </ul>


    <h3>Backend</h3>

    <ul>
        <li>PHP</li>
        <li>Apache Web Server</li>
    </ul>


    <h3>Database</h3>

    <ul>
        <li>MySQL</li>
        <li>Relational database design</li>
        <li>Foreign key relationships</li>
    </ul>



    <h2>Application Architecture</h2>

    <div class="architecture">

        Browser
        <br>
        |
        <br>
        | AJAX Requests
        <br>
        |
        <br>
        PHP Backend
        <br>
        |
        <br>
        MySQL Database

    </div>


    <h2>Database Design</h2>

    <p>
        FriendForest uses a relational database structure designed around
        several interconnected entities:
    </p>

    <ul>
        <li><strong>Users:</strong> Stores account information and profiles.</li>
        <li><strong>Posts:</strong> Stores user-created content.</li>
        <li><strong>Comments:</strong> Stores discussions attached to posts.</li>
        <li><strong>Likes:</strong> Tracks user interactions.</li>
        <li><strong>Followers:</strong> Manages social relationships.</li>
        <li><strong>Messages:</strong> Stores direct communication.</li>
    </ul>



    <h2>Development Challenges</h2>


    <h3>Dynamic Content Updates</h3>

    <p>
        Creating a responsive social feed required implementing AJAX communication
        between the frontend and backend, allowing users to interact with content
        without refreshing the entire page.
    </p>


    <h3>Relational Data Modeling</h3>

    <p>
        Designing relationships between users, posts, comments, likes, followers,
        and messages required careful database planning and SQL query design.
    </p>


    <h3>Authentication and Sessions</h3>

    <p>
        The application uses server-side sessions to maintain authentication state
        and protect user functionality.
    </p>



    <h2>Future Improvements</h2>

    <ul>
        <li>Migrate frontend to React/Next.js</li>
        <li>Create REST API endpoints</li>
        <li>Add real-time messaging with WebSockets</li>
        <li>Add image uploads</li>
        <li>Improve UI/UX design</li>
        <li>Add notifications</li>
        <li>Deploy using cloud infrastructure</li>
    </ul>



    <h2>Purpose</h2>

    <p>
        FriendForest was created to gain practical experience building a complete
        full-stack application. The project demonstrates knowledge of backend
        development, database architecture, authentication systems, frontend
        interactivity, and application design.
    </p>


    <div class="footer">
        Built by Kyle Bergman
    </div>


</div>

</body>
</html>
