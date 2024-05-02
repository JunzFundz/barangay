<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Backup Database
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                  
                <!--/span-->
                <?php
    require_once('backup_restore_class.php'); 

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'db_grade';


    $newImport = new backup_restore($host,$db,$user,$pass);

    if(isset($_GET['process'])){
        $process = $_GET['process'];
        if($process == 'backup'){
            $message = $newImport -> backup ();   
        }else if($process == 'restore'){
            $message = $newImport -> restore (); 
            @unlink('backup_db/database_'.$db.'.sql');
            
        }
    }
    if(isset($_POST['submit'])){        
        $db = 'database_'.$db.'.sql';
        $target_path = 'backup_db';
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_path . '/' . $db);    
        $message = 'Successfully uploaded. You can now <a href=backup.php?process=restore>restore</a> the database!';
    }
?>


<div class="row">
<div class="box">
      <div class="col-lg-offset-2 col-lg-7" style="margin-top: 20px;">

                
             
                        <?php if(isset($_GET['process'])): ?>
                            <?php 
                                $msg = $_GET['process'];   
                                $class = 'text-center';
                                switch($msg){
                                    case 'backup':
                                        $msg = 'Backup successful!<br />Download THE <a href="'.$message.'" target=_blank >SQL FILE </a> OR RESTORE IT ANY TIME'; 
                                        break;
                                    case 'restore':
                                        $msg = $message; 
                                        break;
                                    case 'upload':
                                        $msg = $message; 
                                        break;
                                    default:
                                        $class = 'hide';
                                }                                
                            ?>
                            <div class="alert alert-info <?php echo $class;?>">
                                <strong><?php echo $msg; ?></strong>
                            </div>
                        <?php endif; ?>
                        
        
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-offset-1 col-md-6">
                            <a href="backup.php?process=backup">
                                <button type="button" class="btn btn-success btn-lg span7"><i class="fa fa-database"></i> BACKUP DATABASE</button>
                            </a>
                        </div>
                        <div class="col-md-5">
                            <a href="backup.php?process=restore">
                                <button type="button" class="btn btn-info btn-lg span7"><i class="fa fa-database"></i> RESTORE DATABASE</button>
                            </a>
                        </div>                        
                    </div>
                </div>
                <br />
                <div class="upload alert alert-warning">
                <hr />
                    <form method="POST" enctype="multipart/form-data">
                        <label>Upload SQL File:</label>
                        <input type="file" name="file" class="form-control"><br>
                        <input type="submit" name="submit" class="btn btn-success" value="Upload Database" />
                    </form>
                </div>
            
</div>
</div></div>

    </div><!--/.content-->
</div><!--/.span9-->
                </div>
            
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>

    </body>
</html>