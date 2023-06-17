<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php?lango=2");
    exit;
}   $usernom=$_SESSION["username"];
 $custid=$_SESSION["id"];


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="abdulfatah">
     <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <title> لوحة إضافة خبر مستوي إداري  </title>
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />

  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />

  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
 <?php include("header1.php"); ?>
 <?php include("sidebar.php"); ?>
 <section id="main-content">
 <section class="wrapper">
 <div class="row">
 <div class="row mt">
 <div class="col-lg-12"> 
	


 <? include("config.php");  
	 

    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        
         
   
        
	$random_digit=rand(0000,9999); 
	$file_name = $_FILES['photo']['name'];

/** استخراج لاحقة الملف **/
 
    // Verify file extension
         $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
 
	 $imagename=time().'ekhbary'.$random_digit.'.'.$ext;        
	 $filetype = $_FILES["photo"]["type"];
     $filesize = $_FILES["photo"]["size"];
    
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("../uploads/" . $imagename)){
                echo $imagename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../uploads/" . $imagename);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
	
 
 if($_SERVER["REQUEST_METHOD"] == "POST"){	
 $param_docid= $imagename;





 $sql = "INSERT INTO news_mst (status,post_date,title,news,reporter,page,image,post_by,time_n,publish_date,meta_description,meta_words
)VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssssssssss",

$param_status,$param_post_date,$param_title,$param_news,$param_reporter,$param_page,$param_image,$param_post_by,$param_time_n,$param_publish_date,$param_meta_description,$param_meta_words );
    // Set parameters

$d=$_POST["datew"];
 
$param_status="0"; 
$param_page=trim($_POST["page"]);
$param_time_n=trim($_POST["timew"]);
$param_meta_words=trim($_POST["meta_words"]);
 
$param_title=trim($_POST["title"]);
$param_stitle=trim($_POST["stitle"]);
$param_news=trim($_POST["news"]);
$param_image=$param_docid;
$hhd=$param_docid;
$param_meta_description=trim($_POST["meta_description"]);     
$param_post_by=$usernom;    

$param_post_date=$d;
$mss=trim($_POST["reportertext"]); 

if ($mss==''){
$param_reporter=trim($_POST["reporter"]);
}
else{
$param_reporter=trim($_POST["reportertext"]);
}
  










    // Attempt to execute the prepared statement
  if(mysqli_stmt_execute($stmt)){
  $form_err = "تم إرسال الخبر الي الهيئة التحريرية";
  $form_err = " تم نشر الخبر بنجاح ";
 	
 	
 	
				echo "<script>alert('تم نشر الخبر بنجاح ');
				location='edit_news_me.php'</script>";  } else{
              $form_err = "Oops! Something went wrong. Please try again later.";  
            }
// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($link);}}
?>   <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
             
                 <div class="form" > 
              <?php echo  $form_err ; ?> 
               <form class="cmxform form-horizontal style-form"  enctype="multipart/form-data"  method="post"   id="signupForm"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >   
               

  
 
 <div class="alert alert-success" role="alert">
  
 <?php echo  $form_err ; ?>
 
 شريط خاص بالارشادات من الادارة
  </div>	
<div class="form-group " >
    
<div class="col-sm-12 col-md-12 col-lg-12">

 
 <div class="form-group " >
 <div class="row">
  <div class="col-sm-12 col-md-6 col-lg-6">  
    
  
  

 <div align="right"   style="padding-right: 30px " >  <h5>  تصنيف     </h5></div>
 
 
 
 <div align="right" style="padding-right: 30px ">
 <? include("config.php");
 
$sql = "SELECT * FROM categories   ";   
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
 ?>
 <Select style='width: 255px;' name='page'>
 <?
        while($row = mysqli_fetch_array($result))
		{ ?>
  
		<? echo " <option value='$row[slug]'> $row[category_name]</option> ";?>
		<? }   echo"</Select> " ;
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
?> </div>
			
 
	  
	  <div align="right"  style="padding-right: 30px ">       اليوم  - لا تعدل الا بحالة الخطأ في بياناته </div>


 
  <div align="right" style="padding-right: 30px ">
    <input type="text" name="datew" id="datew"  value="
    <? date_default_timezone_set("UTC");
  $nameday=date("l");
$day=date("d");
$namemonth=date("m");
$year=date("Y"); 

switch ($nameday)
{
case "Saturday":
$nameday="السبت";
break;
case "Sunday":
$nameday="الاحد";
break;
case "Monday":
$nameday="الاثنين";
break;
case "Tuesday":
$nameday="الثلاثاء";
break;
case "Wednesday":
$nameday="الأربعاء";
break;
case "Thursday":
$nameday="الخميس";
break;
case "Friday":
$nameday="الجمعه";
break;
} 


switch ($namemonth)
{
case 1:
$namemonth="يناير";
break;
case 2:
$namemonth="فبراير";
break;
case 3:
$namemonth="مارس";
break;
case 4:
$namemonth="أبريل";
break;
case 5:
$namemonth="مايو";
break;
case 6:
$namemonth="يونيو";
break;
case 7:
$namemonth="يوليو";
break;
case 8:
$namemonth="أغسطس";
break;
case 9:
$namemonth="سبتمبر";
break;
case 10:
$namemonth="أكتوبر";
break;
case 11:
$namemonth="نوفمبر";
break;
case 12:
$namemonth="ديسمبر";
break;
}    ?>
<? echo "  $nameday $day $namemonth $year";   ?> 
 
" "> 
             		 
 </div>  
<div align="right"  style="padding-right: 30px ">       الوقت  - لا تعدل الا بحالة الخطأ في بياناته </div>


 
  <div align="right" style="padding-right: 30px ">
  
    <input type="text" name="timew"   id="timew"   value="  <?  $zone=3600*2;
 //CET;
echo $date=gmdate(" g:i A", time() + $zone);
?> ">
            		
            		 
 </div>
 
 
 
  		 
  <div align="right"  style="padding-right: 30px "> ميتـا الوصف</div>
 <div align="right" style="padding-right: 30px ">
<textarea   name="meta_description" id="meta_description"  rows="3"  style="width: 70%" ></textarea>

 
 </div>
  		 
  <div align="right"  style="padding-right: 30px "> ميتـا كلمات مفتاحية</div>
 <div align="right" style="padding-right: 30px ">
<textarea   name="meta_words" id="meta_words"  rows="2"  style="width: 70%" ></textarea>

 </div>
<div align="right"> عنوان تمهيدي   </div>
 <div align="right">
    <input type='text' style='width: 90%;' name='stitle' value=' '> </div>
    
 </div>
<div class="col-sm-12 col-md-6 col-lg-6">



  <div align="right"  style="padding-right: 30px "> اسم المحرر</div>
 <div align="right" style="padding-right: 30px ">
 <input type='text' size=21 name='reportertext' value='' >  </div>
  

  <div align="right"  style="padding-right: 30px "> اسم المحرر من القوائم</div>

 
 <div align="right" style="padding-right: 30px ">
 <? include("config.php");
 
$sql = "SELECT * FROM users   ";   
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
 ?>
 <Select  name='reporter'name='reporter'>
 <?
        while($row = mysqli_fetch_array($result))
		{ ?>
  
		<? echo " <option value='$row[full_name]'> $row[full_name]</option> ";?>
		<? }   echo"</Select> " ;
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
?> </div>
    
                
		 
  <div align="right"  style="padding-right: 30px "> الفيديو  </div>
 <div align="right" style="padding-right: 30px ">
 <input type='text' size=21 name='videos' value='' >  </div>
 
       <div  align="right"  style="padding-right: 30px ">
  
                <div align="right"  style="padding-right: 30px ">  صورة الخبر  </div> 
               
       <span class="fileupload-preview" align="right"  style="padding-right: 30px "></span>
                      <a href="chingpic.php" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                    </div>
                 
                
                <div class="form-group last">
                
                  <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img  src="../re.jpg"  />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file"  name="photo"  class="default" />
                        </span>
                        <a href="chingpic.php" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                      </div>
                    </div>
                    <span class="label label-info">NOTE!</span>
                    <span>
                      Attached image thumbnail is
                      supported in Latest Firefox, Chrome, Opera,
                      Safari and Internet Explorer 10 only
                      </span>
                  </div>
                </div>
    
              
                 
</div>


    </div>       </div>
        
<div align="right"> عنوان الخبر الرئيسي   </div>
 <div align="right">
    <input type='text' style='width: 95%;' name='title' value=' '> </div>



<div align="right"> نص الخبر   </div>


<div align="right"   >
      <textarea name='news' id="news" >
 
 
    </textarea> 

 
    
   <script>
    ClassicEditor
        .create( document.querySelector( '#news' ) )
        .catch( error => {
            console.error( error );
        } );
</script>



 
 
 </div></div>
    </div>
    
      <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
   
  <button class="btn btn-theme" class="badge badge-pill badge-primary" type="submit">أنشر الخبر    </button>
                      
                      
  <button class="btn btn-theme04"  class="badge badge-pill badge-danger" type="reset" >تراجع  </button>
      </div>
                  </div> 
</div>
  </div> </div></div>
                </form>
              </div>
            </div>
            <!-- /form-panel -->
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <!--footer start-->
   <?php include("footer.php"); ?>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="lib/advanced-form-components.js"></script>


  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>

</body>

</html>
