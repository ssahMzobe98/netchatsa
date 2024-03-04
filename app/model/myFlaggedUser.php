<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    require_once("../controller/pdo.php");
    $pdo=new _pdo_();
    $cur_user_row =$pdo->userInfo($_SESSION['usermail']);
    $userDirect=$cur_user_row['directory_index'];
    $url = explode("/",$_SERVER['REQUEST_URI']);
    $url=str_replace("%20", " ",$url[2]);
    if($url==$userDirect){
        $getUser=$pdo->getReportedUsersByMe($cur_user_row['my_id']);
        // echo"<pre>"; 
        // print_r($getUser);
        // echo"</pre>";
        $size=sizeof($getUser);
        if($size<1){
            echo"No Reported user to display";
        }
        foreach($getUser as $row){
            $name=$row['name'];
            $surname=$row['surname'];
            $username=$row['username'];
            ?>
            <style>
                .domdom{
                    width:100%;
                    padding:2px 10px;
                    box-shadow: 0 8px 6px -6px black;
                }
                .domdom .leftTone{
                    width:100%;
                    padding:5px 10px;
                    color:#45f3ff;
                    text-align:center;
                }
                .domdom .rightTone{
                    width:30%;
                    padding:10px 10px;
                    text-align:center;
                   
                }
                .domdom .rightTone .woo{
                    padding:10px 10px;
                }
            </style>
            <div class="domdom ranch<?php echo $row['id'];?> flex">
                <div class="leftTone">
                    <h6><?php echo $name." ".$surname;?></h6>
                    <h6><?php echo $username;?></h6>
                </div>
                <div class="rightTone" onclick="unFlagUser(<?php echo $row['id'];?>,'<?php echo $row['flaggee'];?>')">
                    <span class="woo badge badge-secondary text-white texte-center;">unFlag</span>
                </div>
                
            </div>
            
            <?php
        }
    }
    else{
        session_destroy();
        ?>
            <script>
                window.location=("../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
            </script>
        <?php
    }
}
else{
    session_destroy();
    ?>
    <script>
        window.location=("../../");
    </script>
    <?php
}
?>