<?php
/****** Copyright © 2018 eMarket ******* 
*   GNU GENERAL PUBLIC LICENSE v.3.0   *    
* https://github.com/musicman3/eMarket *
***************************************/
?>

</head>
<body>

        <div class="lbox-horz"><?php echo $login_error ?></div>
        <div class="lbox-vert"></div>
        
        <div class="login_logo">eMarket <span>v1</span></div>

        
        <div class="login-box side-form">
            <form  action='verify_autorize.php' method='post'>
                <div class="form-group">
                    <input type="text" name="login" class="input-sm form-control" placeholder="<?php echo $lang['email'] ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" class="input-sm form-control" placeholder="<?php echo $lang['password'] ?>">
                </div>
               <input type="hidden" name="action" value='enter'>

               <input type="submit" name='ok' class="btn btn-gr-gray btn-block btn-xs" value="<?php echo $lang['entrance'] ?>">
            </form>
        </div>