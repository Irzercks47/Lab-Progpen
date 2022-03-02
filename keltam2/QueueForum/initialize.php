<html>

<head>
    <title> QueueForum - Initialization Script </title>
    <?php include('components/include.php') ?>
</head>

<body>

    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h1> QueueForum Initialization Script </h1>
            </div>
        </div>

        <?php

        include('database_config.php');

        function create_report($title, $content)
        {
            $report_template =
                '<div class="card mb-3">
            <div class="card-header">{{title}}</div>
            <div class="card-body">
                {{row}}
            </div>
        </div>';

            $row_template =
                '<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                {{body}}
            </div>
        </div>';

            $body_contents = [];
            if (is_array($content)) {
                $body_contents = $content;
            } else {
                $body_contents[] = $content;
            }
            $report_string = str_replace("{{title}}", $title, $report_template);
            $row_string = '';
            foreach ($body_contents as $body) {
                $row_string .= str_replace("{{body}}", $body, $row_template);
            }
            $report_string = str_replace("{{row}}", $row_string, $report_string);
            return $report_string;
        }

        $preflight = new mysqli($server, $username, $password);
        if ($preflight->connect_error) {
            $message = 'Pre-initialization connect failed: ' . $preflight->connect_error;
            die(create_report('Preflight Report', $message));
        }

        $db = "CREATE DATABASE IF NOT EXISTS $database";
        $preflight->query($db);
        $preflight->select_db($database);

        $initialized = false;
        $force = false;

        $init_var_check = "SELECT `value` FROM app_config WHERE `key` = 'initialized'";
        $check = $preflight->query($init_var_check);
        if ($check) {
            $result = $check->fetch_assoc();
            if ($result && $result['value'] == 'true') {
                $initialized = true;
            }
        }

        if ($initialized) {
            $force_param = isset($_REQUEST['force']);
            if ($force_param) {
                $preflight_report_string = create_report("Preflight Report", 'Data has been initialized. Force initialization is issued. This initialization script will re-initialize the application.');
                $force = true;
            } else {
                $preflight_report_string = create_report("Preflight Report", ['Data has been initialized. Please add force parameter if you want to re-initialize the application.', '<a href="?force" class="btn btn-warning">Force Initialization</a>']);
            }
        } else {
            $preflight_report_string = create_report("Preflight Report", 'Application is ready for initialization.');
        }
        echo ($preflight_report_string);

        if (!$initialized || $force) {
            $connection = new mysqli($server, $username, $password, $database);
            if ($connection->connect_error) {
                $message = 'Failed to connect to database: ' . $connection->connect_error;
                die(create_report('MySQLi Connect Report', $message));
            }
            $connection->set_charset('utf8');

            $message = "Successfully established database connection to $database@$server with username $username";
            echo (create_report('MySQLi Connect Report', $message));

            $drop_user_table = "DROP TABLE IF EXISTS users";
            $drop_discussion_table = "DROP TABLE IF EXISTS discussions";
            $drop_comment_table = "DROP TABLE IF EXISTS comments";
            $drop_topic_table = "DROP TABLE IF EXISTS topics";
            $drop_app_config_table = "DROP TABLE IF EXISTS app_config";

            $user_table =
                "CREATE TABLE users (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            username VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255),
            password VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        )";

            $discussion_table =
                "CREATE TABLE discussions (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id INT UNSIGNED NOT NULL,
            title VARCHAR(255),
            content TEXT,
            topic_id INT UNSIGNED NOT NULL,
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX (topic_id)
        )";

            $comment_table =
                "CREATE TABLE comments (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            discussion_id INT UNSIGNED  NOT NULL,
            user_id INT UNSIGNED  NOT NULL,
            comment TEXT,
            PRIMARY KEY (id),
            INDEX (discussion_id, user_id)
        )";

            $topic_table =
                "CREATE TABLE topics (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255),
            PRIMARY KEY (id)
        )";

            $app_config_table =
                "CREATE TABLE app_config (
            `key` VARCHAR(255),
            `value` VARCHAR(255),
            PRIMARY KEY (`key`)
        )";

            if (
                !$connection->query($drop_user_table) ||
                !$connection->query($drop_discussion_table) ||
                !$connection->query($drop_comment_table) ||
                !$connection->query($drop_topic_table) ||
                !$connection->query($drop_app_config_table)
            ) {
                $message = 'Drop tables failed: ' . $connection->error;
                die(create_report('Table Schema Creation Report', $message));
            }

            if (
                !$connection->query($user_table) ||
                !$connection->query($discussion_table) ||
                !$connection->query($comment_table) ||
                !$connection->query($topic_table) ||
                !$connection->query($app_config_table)
            ) {
                $message = 'Table creation failed: ' . $connection->error;
                die(create_report('Table Schema Creation Report', $message));
            }

            echo (create_report('Table Schema Creation Report', ['Successfully drops all 5 tables (users, discussions, comments, topics, app_config)', 'Successfully creates all 5 tables (users, discussions, comments, topics, app_config)']));

            $insert_users = "INSERT INTO users (username, name, password, email) VALUES (?, ?, SHA1(?), ?)";
            $insert_users_stmt = $connection->prepare($insert_users);

            $insert_discussions = "INSERT INTO discussions (user_id, title, content, topic_id) VALUES (?, ?, ?, ?)";
            $insert_discussions_stmt = $connection->prepare($insert_discussions);

            $insert_comments = "INSERT INTO comments (discussion_id, user_id, comment) VALUES (?, ?, ?)";
            $insert_comments_stmt = $connection->prepare($insert_comments);

            $insert_topics = "INSERT INTO topics (name) VALUES (?)";
            $insert_topics_stmt = $connection->prepare($insert_topics);

            $insert_app_config = "INSERT INTO app_config VALUES (?, ?)";
            $insert_app_config_stmt = $connection->prepare($insert_app_config);

            if (
                !$insert_users_stmt ||
                !$insert_discussions_stmt ||
                !$insert_comments_stmt ||
                !$insert_topics_stmt ||
                !$insert_app_config_stmt
            ) {
                $message = 'Statement preparation failed: ' . $connection->error;
                die(create_report('Statement Preparation Report', $message));
            }

            echo (create_report('Statement Preparation Report', 'Statement preparation successful'));

            $dummy_names = [
                "Merilin Anastasia",
                "Damian Yen",
                "Luis Huang",
                "Verlyn Verensia"
            ];

            foreach ($dummy_names as $name) {
                $names = explode(' ', $name);

                $username = strtolower($names[0][0] . $names[1]);

                $email = strtolower("$names[1].$names[0]@qo.com");

                $password = $username;

                $insert_users_stmt->bind_param("ssss", $username, $name, $password, $email);
                $insert_users_stmt->execute();
            }

            $dummy_topics = [
                "Python",
                "Firebase",
                "CSS",
                "Technology",
                "PHP",
                "Blog"
            ];

            foreach ($dummy_topics as $topic) {
                $insert_topics_stmt->bind_param("s", $topic);
                $insert_topics_stmt->execute();
            }

            $dummy_discussions = [
                [
                    'user_id' => 1,
                    'title' => 'How get number of active users from Firebase?',
                    'content' => 'I use Firebase to analyze user data in my android project. When I want to get the number of all active users in the last 90 days, it did not show as how I want it to be',
                    'topic_id' => 2
                ],
                [
                    'user_id' => 2,
                    'title' => "Python",
                    'content' => "What is python?",
                    'topic_id' => 1
                ],
                [
                    'user_id' => 2,
                    'title' => 'How can I make accordion using CSS?',
                    'content' => 'Can someone please tell me how to make it?',
                    'topic_id' => 3
                ],
                [
                    'user_id' => 4,
                    'title' => 'Blogging',
                    'content' => 'What is blogging and how can I start my own blog?',
                    'topic_id' => 6
                ],
            ];

            foreach ($dummy_discussions as $discussion) {
                $user_id = $discussion['user_id'];
                $title = $discussion['title'];
                $content = $discussion['content'];
                $topic_id = $discussion['topic_id'];
                $insert_discussions_stmt->bind_param("issi", $user_id, $title, $content, $topic_id);
                $insert_discussions_stmt->execute();
            }

            $dummy_comments = [
                [
                    'user_id' => 2,
                    'discussion_id' => 1,
                    'comment' => "There is no built-in report to show the 90-day active users.

            If you want to know how many users were active in the last 90 days, you'll have to export the data to BigQuery, and perform the required query there. There is a sample Google Data Studio template that looks similar to the Firebase console, which you might use as a starting point for your custom queries."
                ],
                [
                    'user_id' => 3,
                    'discussion_id' => 2,
                    'comment' => "Python is a multi-paradigm, dynamically typed, multipurpose programming language, designed to be quick (to learn, to use, and to understand), and to enforce a clean and uniform syntax."
                ],
                [
                    'user_id' => 1,
                    'discussion_id' => 4,
                    'comment' => "Blogging is a generic, watered-down term referring to posting on the Internet on a regular basis. Blog is basically a shortened version of web log. Initially it was really just people writing diary or journal entries on the Web for anyone to see. Now, most people use it just to post their opinions about something or ramble and rant. You can find and follow blogs for just about any topic imaginable: food, cooking, music, woodworking, photography, etc.
            Please do not consider blogging as journalism- it misses key elements like objectivity, fact-checking, etc.  Unfortunately much of journalism today has taken the form of blogging which is why most of it is pure crap."
                ],
                [
                    'user_id' => 2,
                    'discussion_id' => 4,
                    'comment' => "The platform of blogging has morphed into something far different from its original conception. Starting a blog has come into its own. A cross between social media and an outlet for news, it has grown steadily, but in comparison to the term 'social media' it has done so under the radar. Your question, has become Question 2. The first question you should ask yourself is Why Do i Want to Blog? With purpose in hand, selecting a platform and a theme the answer to your question) focuses your search and leads to a decision. If your blog is a stepping stone or platform for your career, then starting it with a bang is more conducive than trial and error. If blog is a journal or family fun, then the necessity of understanding industry standards like SEO, viewer stats and the like, become less relevant, because they can take up a whole lot of time. Somewhat more complex than establishing a Facebook account, but on hosted platforms like Wordpress and blogger, they offer read-made blogs, as if you are a techie and built your own site."
                ],
                [
                    'user_id' => 3,
                    'discussion_id' => 4,
                    'comment' => "I think you are already flooded with good answers so perhaps I can just provide a short list:
            - google how to create traction for a blog. You want people following you, I assume, and there are great articles out there advising you how to find them.
            - make sure you write something original, that actually adds something of value for other people.
            - if you are new to blogging, Wordpress is a very popular choice. You can install it on most web hosting providers.
            - visit blogs of people who a similar concepts and topics of interest and see how they create layout and how they write. Of course you will need to add your own unique touch, but it never hurts to learn from more experienced people.
            
            Good luck!"
                ],
            ];

            foreach ($dummy_comments as $comment) {
                $discussion_id = $comment['discussion_id'];
                $user_id = $comment['user_id'];
                $comment_content = $comment['comment'];
                $insert_comments_stmt->bind_param("iis", $discussion_id, $user_id, $comment_content);
                $insert_comments_stmt->execute();
            }

            $key = 'initialized';
            $value = 'true';
            $insert_app_config_stmt->bind_param("ss", $key, $value);
            $insert_app_config_stmt->execute();

            echo (create_report(
                'Table Seeder Report',
                [
                    'User data entered (' . count($dummy_names) . ' data)',
                    'Question data entered (' . count($dummy_discussions) . ' data)',
                    'Answer data entered (' . count($dummy_topics) . ' data)'
                ]
            ));

            $name = $dummy_names[rand(0, count($dummy_names) - 1)];
            $names = explode(' ', $name);
            $username = strtolower($names[0][0] . $names[1]);
            echo (create_report('Initialization Completed', [
                "You can log in with this credential (username/password): $username/$username",
                "All default credentials generated through this initialization has the password set equal to the username",
                '<a href="login.php" class="btn btn-info">Open Website</a>'
            ]));
        }
        ?>
    </div>
</body>

</html>