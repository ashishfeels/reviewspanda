<?php
ob_start();
require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--------------------------------META TAGS STARTS ---------------------------------->
    <meta name="title" content="ReviewzPanda - Movie Reviews, Redfined Honest Reviews & Ratings " />
    <meta name="keywords" content=" reviewzpanda, imdb, ratings, movie reviews, movie ratings, rottentomatoes, bollywood movies reviews, public reviews,youtube, avengers, movie analysis,box office collections,movies 2019, movies rating website,web series,tv series, panda, indian movies, hindi movies,reviewspanda" />
    <meta name="description" content=" Movie Reviews, that  analyze movies without any bias and assess them on its overall impact." />
    <meta name="google-site-verification" content="dd2pFGUek6PowgIn4VaRLfOjo5NxfUdfKz-ZD110DEk" />
    <meta name="MobileOptimized" content="width" />
    <meta name="HandheldFriendly" content="true" />
    <!--------------------------------- META TAGS ENDS------------------------------------>
    <title>ReviewzPanda | Reviews Redefined</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Antic|Jura|Khand|Rajdhani" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics  STARTS-->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132749076-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-132749076-1');
        </script>
    <!-- Global site tag (gtag.js) - Google Analytics ENDS -->

    <!--------------------------- ONESIGNAL PUSH STARTS -------------------------->
    <link rel="manifest" href="/manifest.json" />
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
          OneSignal.init({
            appId: "03c9fea3-3efd-43ac-a897-39975ab7d092",
          });
        });
    </script>
    <!------------------------------ ONE SIGNAL PUSH ENDS ---------------------------->
  </head>

  <body>
    <div class="primary-nav">
      <button href="#" class="hamburger open-panel nav-toggle">
      <span class="screen-reader-text">Menu</span>
      </button>
      <nav role="navigation" class="menu">
        <a href="index.php" class="logotype"><img src="revp.png" alt=""></a>
        <div class="overflow-container">
          <ul class="menu-dropdown">
            <li><a href="index.php">Home</a><span class="icon"><i class="fas fa-home"></i></span></li>
            <li class="menu-hasdropdown">
              <a href="#">Upcoming Reviews</a><span class="icon"><i class="fas fa-clock"></i></span>
              <label title="toggle menu" for="settings">
                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
              </label>
              <input type="checkbox" class="sub-menu-checkbox" id="settings" />
              <ul class="sub-menu-dropdown">
                <li><a href="">Bollywood</a></li>
                <li><a href="">Hollywood</a></li>
                <li><a href="">Tv/Web Series</a></li>
              </ul>
            </li>
            <li><a href="#">Movies News (TBR)</a><span class="icon disabled"><i class="fas fa-film"></i></span></li>
            <li><a href="#">About Me</a><span class="icon"><i class="fas fa-user-circle"></i></i></span></li>
            <div class="fixed-bottom text-center"> <span class="ftext">All Right Reserved &copy ReviewzPanda</span></div>
          </div>
        </nav>
      </div>
      <div class="new-wrapper container-fluid no-padding">
        <div id="main">
          <div class='wrapper'>
            <?php
            // This is dynamic posters and the link goes
            $popular = mysqli_query($conn,"SELECT * FROM editorial ORDER BY article_id DESC LIMIT 5");
            $cls = ['ryze','irelia','jinx','katarina','ziggs'];
            $i=0;
            while ($i<count($cls) && $row = mysqli_fetch_array($popular)){
            
            
            echo '<div class="item '.($cls[$i]).' feature" style="background-image: url(admin/' .($row['file_dest']) . ');"> <a class ="title" href ="reviews.php?movie_id='.rawurlencode($row['movname']).'"> ' .($row['edtopic']) . ' </a></div>';
            $i++;
            }
            
            
            ?>
          </div>
          <!-- reviews and data -->
          <div class="row">
            <div class="col-md-7">
              <div class="reviewtag">
                <h5> Recently Reviewed</h5>
              </div>
              <!-- pagefold it -->
              <?php
              if (isset($_GET['pageno'])) {
              $pageno = $_GET['pageno'];
              } else {
              $pageno = 1;
              }
              $no_of_records_per_page = 5;
              $offset = ($pageno-1) * $no_of_records_per_page;
              $total_pages_sql = "SELECT COUNT(*) FROM editorial";
              $result = mysqli_query($conn,$total_pages_sql);
              $total_rows = mysqli_fetch_array($result)[0];
              $total_pages = ceil($total_rows / $no_of_records_per_page);
              $result2 = "SELECT * FROM editorial ORDER BY article_id DESC LIMIT $no_of_records_per_page  OFFSET $offset";
              $resultq = mysqli_query($conn,$result2);
              while ($row = mysqli_fetch_array($resultq)) {
              // upto here
              echo '
              <div class="row reviewbox ">
                <div class="col-md-4 ">
                  <img src="admin/'.$row["file_dest"].'" class="revimg img-fluid"/>
                </div>
                <div class="col-md-8 content" >
                  <div>
                    <a class ="title" href ="reviews.php?movie_id='.rawurlencode($row['movname']).'"> ' .($row['edtopic']) . ' </a>
                  </div>
                  <div class="author">
                    <small><i class="fas fa-calendar-alt">&nbsp '.($row['updatetime']).'</i> &nbsp by </small>&nbsp
                    <small><i class="fas fa-user-alt"></i>&nbsp '.($row['Updated_by']).'</small> </br>
                  </div>
                  
                  <div id="fos" class="container-fluid no-padding">
                    <p class="text-justify">'.strip_tags(substr("$row[7]", 0, 500)).'</p>
                  </div>
                </div>
              </div>';
              }
              ?>
              <div class="col-12">
                <!-- pagefold it counts -->
                <ul class="pagination">
                  <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                  </li>
                  <li class="page-item"><a href="?pageno=1" class="page-link" href="#">1</a></li>
                  <li class="page-item"><a href="?pageno=2" class="page-link" href="#">2</a></li>
                  <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="?pageno=3" class="page-link" href="#">3</a>
                  </li>
                  <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                  </li>
                </ul>
                
              </div>
            </div>
            <div class="col-md-5">
              <div class="row">
                
                <div class="col-md-11 sidebar popular">
                  <h5> Popular Reviews</h5>
                  <?php
                  $popular = mysqli_query($conn,"SELECT file_dest,edtopic,movname FROM editorial ORDER BY hits DESC LIMIT 5");
                  while ($row = mysqli_fetch_array($popular)) {
                  echo '
                  <div class="fullbox">
                    <div class="row popreviews">
                      <div class="col-md-4 col-sm-2">
                        <img src="admin/'.$row["file_dest"].'" class="popimg img-fluid"/>
                      </div>
                      <div class="col-md-8 col-sm-10 popdata" >
                        <a class ="title" href ="reviews.php?movie_id='.rawurlencode($row['movname']).'"> ' .($row['edtopic']) . ' </a>
                      </div>
                    </div> </div>';
                    }
                    ?>
                    
                  </div>
                  
                  <div class="col-md-11 sidebar ">
                    <h5>We Are Social</h5>
                    <button onclick="location.href='https://www.facebook.com/reviewzpanda'" class="icon-btn facebook">
                    <a class="link" href="https://www.facebook.com/">
                      <i class="fab fa-facebook-f "></i>
                    </a>
                  </button>
                    <button onclick="location.href='https://www.instagram.com/reviewzpanda'" class="icon-btn instagram">
                    <a class="link" href="https://www.instagram.com/">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </button>
                    <button onclick="location.href='https://www.twitter.com/reviewzpanda'" class="icon-btn twitter">
                    <a class="link" href="https://twitter.com/">
                      <i class="fab fa-twitter "></i>
                    </a>
                    </button>
                    <button class="icon-btn google-plus">
                    <a class="link" href="https://plus.google.com/">
                      <i class="fab fa-google-plus-g "></i>
                    </a>
                    </div>
                    </button>
                  </div>
                  
                  <div class="col-md-11 sidebar">
                    <h5> Upcoming Releases</h5>
                    <p class="text-center"> A Lot To Come Here Soon !! <br> Reviewzpanda</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---------------------------------------------------- Bootstrap Plugins ---------------------------------------->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
      <script src="script.js"></script>
    </body>
  </html>