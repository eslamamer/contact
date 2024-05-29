<?php
    //check the type of request mesthod
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $NAME     = filter_var($_POST['uname'], FILTER_SANITIZE_STRING);
        $EMAIL    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $PHONE    = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $MSG      = filter_var($_POST['textarea'], FILTER_SANITIZE_STRING);

        $ERROR = array();
        if(strlen($NAME) < 3){
            $ERROR[] = 'name must be more than three characters ';
        }
        if(strlen($EMAIL) < 3){
            $ERROR[] = 'EMAIL must be more than three numbers ';
        }
        if(strlen($PHONE) < 3){
            $ERROR[] = 'PHONE must be more than three numbers ';
        }
        if(strlen($MSG) < 3){
            $ERROR[] = 'MSG must be more than three characters ';
        }
         //if no errors send mail
        //mail( string $to , string $subject , string $message [, mixed $additional_headers [, string $additional_parameters ]]): bool
        if(empty($ERROR)){
            mail($EMAIL, 'mail subject ', $MSG, 'mail from '.$NAME, 'phone number '.$PHONE );
            $NAME     = '';
            $EMAIL    = '';
            $PHONE    = '';
            $MSG      = '';
            $success = '<div class="alert alert-success"> message sent successfully </div>';
        }
      
    }
   
    
?>
                                '
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./css/contact.css"/>
            <link rel="stylesheet" href="./css/fontawesome.min.css" />
            <link rel="stylesheet" href="./css/bootstrap.min.css" />            
            <title>Contact</title>
        </head>
        <body>
            <div class="container"> 
                <h1 class=' text-center text-success-emphasis opacity-50'>contact me</h1>
                <form class="con-form" action = <?php echo $_SERVER['PHP_SELF'] ?>  method = 'POST'>
                <?php if(! empty($ERROR)){ ?>
                    <div class="alert alert-warning alert-dismissible fade show mb-7" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <?php 
                            foreach ($ERROR as $M) {
                                echo $M .'<br/>';
                            }
                        ?>
                    </div>
                    <?php }
                        if(isset($success)) {echo $success;}
                    ?>
                    
                    <div class="form-group">
                        <input 
                            class="form-control co" 
                            type="text" 
                            name="uname" 
                            placeholder="user name"
                            value='<?php echo $NAME?>'
                        />
                        <span class='icon'><i class="fa fa-user fw"></i></span>
                        <span class='asterisk'>*</span>
                    </div>
                    <div class="form-group">
                        <input 
                            class="form-control" 
                            type="email" 
                            name="email" 
                            placeholder="E-mail"
                            value='<?php echo $EMAIL?>'
                        />
                        <span class='icon'><i class="fa fa-envelope fw"></i></span>
                        <span class='asterisk'>*</span>
                    </div>
                    <div class="form-group">
                        <input 
                            class="form-control" 
                            type="text" 
                            name="phone" 
                            placeholder="user phone number"
                            value='<?php echo $PHONE?>'
                        />
                        <span class='icon'><i class="fa fa-phone fw"></i></span>
                    </div>
                    <div class="form-group">
                        <textarea 
                            name="textarea"
                            class="form-control" 
                            placeholder="write your MSG"><?php echo $MSG ?></textarea>
                        <span class='asterisk'>*</span>
                    </div>
                    <div class="form-group">
                        <input 
                                class="btn btn-success" 
                                type="submit" 
                                value="send"
                            />
                        <span class='icon'><i class="fa-solid fa-comment-dots fw "></i></span>
                    </div>
                </form>
            </div>



            <script src="./js/jquery-3.7.1.min.js"></script>
            <script src="./js/bootstrap.min.js"></script>
            <script src="./js/fontawesome.min.js"></script>
        </body>
    </html>