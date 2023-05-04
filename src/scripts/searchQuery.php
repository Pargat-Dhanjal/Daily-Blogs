<?php
//connect to database
include('../scripts/connection.php');

//start the session
session_start();

//get search term from POST request
$search = $_POST['search'];

//sanitize search term
$search = mysqli_real_escape_string($conn, $search);

//query for blogs with matching title
$query = "SELECT * FROM blogs WHERE title LIKE '%$search%' OR content LIKE '%$search%' OR hashtags LIKE '%$search%'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // Display search results as HTML
    echo '<div class="myblogs">';
    while ($blog = $result->fetch_assoc()) {
        $date = date('d', strtotime($blog['date_of_upload']));
        $month = date('m', strtotime($blog['date_of_upload']));
        $array = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $month = $array[$month - 1];
        // get the username of the user who uploaded the blog
        $result2 = $conn->query("SELECT u.username FROM users u JOIN blogs b ON b.userid = u.userid WHERE b.blogid = " . $blog['blogid']);
        $user = mysqli_fetch_assoc($result2);

        echo '<div class="blog-wrapper">
                  <div class="left-div">
                      <div class="date">' . $date . '<br>' . $month . '</div>
                      <div class="username-div">
                          <h4 class="username">
                              <a class="username-tag" href="./profile.php?userid=' . $blog['userid'] . '">@' . $user['username'] . '</a>
                          </h4>
                      </div>
                  </div>
                  <div class="right-div">
                      <div class="title">
                          <h2>' . $blog['title'] . '</h2>
                      </div>
                      <div class="blog">
                          <div class="content">
                              <p class="description">' . $blog['content'] . '</p>
                              <a class="readmore" href="./blog.php?blogid=' . $blog['blogid'] . '">read more . . .</a>
                              <div class="tags">
                                  <a>#meditation</a>
                                  <a>#meditation</a>
                              </div>
                          </div>
                          <div class="image">
                              <img src="../images/blog_data/' . $blog['blogid'] . '.png"/> 
                          </div>
                      </div>
                  </div>
              </div>';
    }
    echo '</div>';
} else {
    echo '<p>No results found.</p>';
}
