<?php
 require __DIR__ . '/vendor/autoload.php';
 //session_start();
 require 'bootstrap.php';
 include 'check.php';
 include './autoriz.php';
 //include './signUpVk.php';
 include 'checkVk.php';

 require 'AutoLoad.php';

        

 include_once __DIR__ . '/Monolog/Logger.php';
 include_once __DIR__ . '/Monolog/Handler/HandlerInterface.php';
 include_once __DIR__ . '/Monolog/Handler/AbstractHandler.php';
 include_once __DIR__ . '/Monolog/Handler/AbstractProcessingHandler.php';
 include_once __DIR__ . '/Monolog/Handler/StreamHandler.php';
 
 include_once __DIR__ . '/Monolog/Formatter/FormatterInterface.php';
 include_once __DIR__ . '/Monolog/Formatter/NormalizerFormatter.php';
 include_once __DIR__ . '/Monolog/Formatter/LineFormatter.php';
 
 
 
 use Monolog\Logger;
 use Monolog\Handler\StreamHandler;
 
 // create a log channel
 $log = new Logger('myLogger');
 $log->pushHandler(new StreamHandler(__DIR__ . '/MyLog.log', Logger::WARNING));

 // Хендлер, который будет писать логи в "troubles.log" и реагировать на ошибки с уровнем "ALERT" и выше.
$log->pushHandler(new StreamHandler(__DIR__ . '/MyLog.log', Logger::ALERT));
 
 // add records to the log
 $log->warning('Предупреждение');
 $log->error('Большая ошибка');
 $log->info('Просто тест');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Mountain King - Bootstrap Template</title>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/theme.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700,100' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:300,700,900,500' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.7/typicons.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/pushy.css">   
        <link rel="stylesheet" href="assets/css/animate.css">
    </head>
    <body class="">
      <!-- Pushy Menu -->
      <nav class="pushy pushy-left">
        <ul class="list-unstyled">
            <li><a href="#home">Home</a></li>
            <li><a href="#feat">Features</a></li>
            <li><a href="#about">About me</a></li>
            <li><a href="#news">My Blog</a></li>
            <li><a href="#history">My History</a></li>
            <li><a href="#photos">Look my Photos</a></li>
            <li><a href="#contact">Get in Touch!</a></li>
            <li><a href="#download" target="_blank">Download</a></li>
        </ul>
      </nav>

      <!-- Site Overlay -->
      <div class="site-overlay"></div>

        <header id="home">
            
            <div class="container-fluid">
                <!-- change the image in style.css to the class header .container-fluid [approximately row 50] -->
                <a href="logout.php" class="btn btn-lg btn-danger logout">logOut</a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-xs-10">
                            <a href="#" class="thumbnail logo">
                                <img src="images/your_logo.png" alt="" class="img-responsive">
                            </a>
                        </div>
                        
                        <div class="col-md-1 col-md-offset-8 col-xs-2 text-center">
                          <div class="menu-btn"><span class="hamburger">&#9776;</span></div>
                        </div>
                    </div>
                    <div class="jumbotron">
                        <h1><small><?php check(); ?></small></br></h1>
                        <?php 
                          if (!autoriz()){
                            echo '<p>Зарегестрируйтесь, что б вы могли видеть комментарии к фото<br></p>
                            <p>
                                <a href="signUp.php" class="btn btn-primary btn-lg" role="button" >Sign UP</a> 
                                <a href="signIn.php" class="btn btn-lg btn-danger" role="button">Sign IN</a>
                            </p>';
                          }
                        ?>
                        

                    </div>
                </div>
            </div>
        </header>

        <section>
            <div>
                <?php
                    if($_SESSION['login'] == "Admin"){
                        echo '<table>
                            <tr>
                                <td style="width:100px">User</td>
                                <td style="width:100px">Status</td>
                            </tr>
                            
                        </table>';
                        //showUsers();


                        
                            $users = getUsersLists();

                            if(!empty($users)){
                                foreach($users as $user){
                                    if ($user['login'] != "Admin"){
                                        echo '
                                        <table>
                                        <tr>
                                            <td class="tdLogin" style="width:100px">'.$user['login'].'</td>
                                            <td class="tdStatus" style="width:100px">'.$user['status'].'</td>
                                            <td><form action="stChange.php" method="POST" >
                                            <input type="hidden" name="tdName" value="'.$user['login'].'" />
                                                <select class="form-select" aria-label="Default select example" name="selectName">
                                                    <option value="user">user</option>
                                                    <option value="manager">manager</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary" name="statusChange">Change</button>    
                                                </form>
                                                </td>
                                        </tr>
                                        
                                    </table>
                                        ';
                                    }
                                    
                                }
                            }


                    }
                    if ($_SESSION['vk'] == "authorized"){
                         //signUpVk();
                    }
                    
                ?>
            </div>
            <div>
            <?php 
                if  (autoriz()){
                    include './load.php';
                } else {
                    include './loadLogOut.php';
                }
            ?>
            </div>
            
        </section>

        <section>

              <div class="container">
                    
                        <h1><small><?php checkVk(); ?></small></br></h1>
                        
                        <h1><small><?php autorizVk (); ?></small></br></h1>
              </div>  

        </section>

        <section>

              <div class="container">
                    
              <?php
                include 'userRole.php';
              ?>

              </div>  

        </section>
        
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Your Logo</h3>
                        <p>© 2016 Your Company. Designed and Developed by <a target="_blank" href="#"></a></p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-right social"><i class="typcn typcn-social-facebook-circular"></i><i class="typcn typcn-social-twitter-circular"></i><i class="typcn typcn-social-tumbler-circular"></i><i class="typcn typcn-social-github-circular"></i><i class="typcn typcn-social-dribbble-circular"></i></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.min.js"></script> 
        <script src="assets/js/pushy.min.js"></script>
        
        
        
    </body>
</html>
