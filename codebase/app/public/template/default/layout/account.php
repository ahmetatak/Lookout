<!DOCTYPE html>
<html>
    <head>
    <title><?php echo $this->title." - ".SITE_TITLE; ?></title>
    <base href="/" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->css;?>
         <link rel="stylesheet" type="text/css" href="<?php echo URL."/template/".TEMPLATE ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL ;?>/template/<?php echo TEMPLATE;?>/css/style.css">
          <link rel="shortcut icon" href="<?php echo URL."/template/".TEMPLATE ?>/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo URL."/template/".TEMPLATE ?>/img/favicon.ico" type="image/x-icon">  
    <script src="<?php echo URL ;?>/template/<?php echo TEMPLATE;?>/js/jquery.js" type="text/javascript" language="JavaScript"> </script>    
   
      
       <script src="<?php echo URL ;?>/template/<?php echo TEMPLATE;?>/js/bootstrap.min.js" type="text/javascript" language="JavaScript"> </script>  
     
</head>
<body> 

             
        <div class="container-fluid body"><div class="container">
       <?php  if(isset($this->view))
{
     
      echo  $this->view;
}else
    echo _("View File is not exist!");
?> 
    </div></div> 
 
  <?php echo $this->js;?>
</body>
</html>


