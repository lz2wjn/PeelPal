<?php 
 include('oldScaffolding/connectionData.txt');
 $mysqli = new mysqli($server, $user, $pass, $dbname, $port)
 or die('Error connecting');
 ?>

<?php 
//echo '->'.$_POST['selectedGoal_id'].'<br>';
$selectedGoal_id=$_POST['selectedGoal_id'];

?>	

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=320, height=device-height">


    <title>Peel Pages</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">

</head>


<body id="page-top" class="index">
<?php		
	$add_date = $_POST['add_date'];			
	$add_des = $_POST['add_des'];			
	$add_num = $_POST['add_num'];	
	$selectedGoal_id=$_POST['selectedGoal_id'];
		
	//$add_email = $_POST['add_email'];			
	//$add_address1 = $_POST['add_address1'];			
	//$add_address2 = $_POST['add_address2'];			
	//$add_city = $_POST['add_city'];			
	//$add_state = $_POST['add_state'];			
	//$add_zip = $_POST['add_zip'];			
	//	$addId = $_POST['addId'];
	
	
	if((!empty($add_date))||(!empty($add_des))){			
		
		
		$stmt = $mysqli -> prepare("SELECT COUNT(*) FROM peelPal.updateprog u WHERE (u.description ='".$add_des."') AND (u.evaluate_num ='".$add_num."') AND (u.date ='".$add_date."') AND (u.goal_id ='".$selectedGoal_id."');");
		$stmt->execute();
		$countNum=null;
		$stmt->bind_result($countNum);		
		while($stmt->fetch())printf('',$countNum);			
		
		if($countNum<1)
		{			
			$stmt = $mysqli -> prepare("INSERT INTO `peelPal`.`updateprog` (`description`, `evaluate_num`, `date`, `goal_id`) VALUES ('".$add_des."','".$add_num."','".$add_date."','".$selectedGoal_id."');");
			$stmt->execute();

		//$nihao = UPDATE `peelPal`.`goal` SET `last_act`='2017-02-05' WHERE `goal_id`='5';
			$stmt = $mysqli -> prepare("UPDATE `peelPal`.`goal` SET `last_act`='".$add_date."' WHERE `goal_id`='".$selectedGoal_id."';");
			$stmt->execute();
			
			$stmt = $mysqli -> prepare("UPDATE `peelPal`.`target` SET `l_value`='".$add_num."' WHERE `goal_id`='".$selectedGoal_id."';");
			$stmt->execute();
		}
	}	
?> 
<?php		
	$edit_date = $_POST['edit_date'];			
	$edit_des = $_POST['edit_des'];			
	$edit_num = $_POST['edit_number'];	
	$selectedGoal_id=$_POST['selectedGoal_id'];
	$upgr_id= $_POST['contact_Id'];
		
	//$add_email = $_POST['add_email'];			
	//$add_address1 = $_POST['add_address1'];			
	//$add_address2 = $_POST['add_address2'];			
	//$add_city = $_POST['add_city'];			
	//$add_state = $_POST['add_state'];			
	//$add_zip = $_POST['add_zip'];			
	//	$addId = $_POST['addId'];
	
	
	if((!empty($edit_date))||(!empty($edit_des))){			
		$stmt = $mysqli -> prepare("SELECT COUNT(*) FROM peelPal.updateprog u WHERE u.up_id ='".$upgr_id."';");
		$stmt->execute();
		$countNum=null;
		$stmt->bind_result($countNum);				
		while($stmt->fetch())printf('',$countNum);	
				
		if($countNum==1)
		{			
			$stmt = $mysqli -> prepare("UPDATE `peelPal`.`updateprog` SET `description`='".$edit_des."', `evaluate_num`='".$edit_num."', `date`='".$edit_date."' WHERE `up_id`='".$upgr_id."'; ");
			$stmt->execute();
			
			
			$stmt = $mysqli -> prepare("SELECT last_act FROM peelPal.goal WHERE goal_id = '".$selectedGoal_id."'; ");
			$stmt->execute();
			$edit_ls=null;
			$stmt->bind_result($edit_ls);				
			while($stmt->fetch())printf('',$edit_ls);
			
			echo"<script>alert(wusuowei);</script>";
			
			//echo 
			
			if($edit_date == $edit_ls)
			{
				$stmt = $mysqli -> prepare("UPDATE `peelPal`.`target` SET `l_value`='".$edit_num."' WHERE `goal_id`='".$selectedGoal_id."'; ");
				$stmt->execute();
			}	


		}
	}	
?>   
	<div id="myModal" class="modal">
				<!-- Modal content -->
				<div class="modal-content">
					<span id="add_close" class="close">&times;</span>
					<h3>Add Update</h3>
					<form action="quantitative.php" method="POST" id="senddForm" style="margin-top: 2%;">	
						<table class="addContact">
							<tr>
								<td>
									<p>Date:	</p>
								</td>
								<td>
									<input type="text" name="add_date" id="add_date" required>
								</td>
							</tr>
							<tr>
								<td>
									<p>Description:	</p>
								</td>
								<td>
									<input type="text" name="add_des" id="add_des" required>

							</tr>
							<tr>
								<td>
									<p>Number:	</p>
								</td>
								<td>
									<input type="text" name="add_num" id="add_num" required>
								</td>
							</tr>

							<tr>
								
								<td>
									<input style=""type="text" name="selectedGoal_id" value="<?php echo $selectedGoal_id;?>">								
								</td>
								<td>
									<input class="btn btn-success" type="submit" value="Save" style="float: right;" >
									<input class="btn btn-success" type="reset" value="Erase" style="float: right; margin-right: 20px;">		
								</td>
							</tr>
						</table>
					</form> 
				</div>
			</div>
	<div id="edit_myModal" class="modal">
            <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Please fill information</h3>
            <form action="quantitative.php" method="POST" id="sendForm" style="margin-top: 2%;">	
            	<table class="addContact">
					<tr>
						<td>
							<p>Date:	</p>
						</td>
						<td>
							<input type="text" name="edit_date" id="edit_da" readOnly="true" required>
						</td>
					</tr>                
					<tr>
						<td>
							<p>Description:	</p>
						</td>
						<td>
							<input type="text" name="edit_des" id="edit_de" required>
						</td>
					</tr>                
					<tr>		
						<td>
							<p>Number:	</p>
						</td>					
						<td>
							<input type="text" name="edit_number" id="edit_num" required>
						</td>								
					</tr>                				
					<tr>               
									
						<td>
							<input style="width: 50px; "type="text" name="selectedGoal_id" value="<?php echo $selectedGoal_id;?>">
							<input style="width: 50px; "type="text" name="contact_Id" id="edit_contact_Id">		
						</td>					
						<td>
							<input class="btn btn-success" type="submit" value="Save" style="float: right;">
							<input class="btn btn-success" type="reset" value="Erase" style="float: right; margin-right: 20px;">		
						</td>
					</tr>				
                </table>
            </form>                  
            </div>
		</div>	
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="././goals.php"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="././goals.php">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="portfolio" class="bg-light-gray">

		<div class="row">
			<div class="col-lg-12 text-center">
			<?php
			$selectedGoal_id=$_POST['selectedGoal_id'];
			$stmt = $mysqli -> prepare("SELECT g_name FROM goal WHERE goal_id=$selectedGoal_id;");
			$stmt->execute();
			$top_goal_name=null;
					
			$stmt->bind_result($top_goal_name);
			$stmt->store_result();
			while($stmt->fetch())printf('<h1 style="margin-left: 20%%; color: white;text-align: left;" class="section-heading">%s</h1>',$top_goal_name);
			
			?>
			</div>
		</div>
		<hr style="border-top: 2px solid #fff;">        
        <div class="container" style=" ">		
		<div class="row">			
								    
			<?php
			$selectedGoal_id=$_POST['selectedGoal_id'];
			$stmt = $mysqli -> prepare("SELECT ABS(t.l_value - t.s_value)/ABS(t.t_value - t.s_value) diff FROM goal g JOIN target t ON g.goal_id = t.goal_id WHERE g.goal_id = $selectedGoal_id");
			$stmt->execute();
		
			$tar_diff=null;		
			//$tmpTotal=null;		
			$stmt->bind_result( $tar_diff);
			$stmt->store_result();
			while($stmt->fetch())printf('
             <div class="col-md-9 col-sm-8 portfolio-item">                  
                  <div style="padding: 0px; margin: 0px; max-width: 760px;" class="portfolio-caption">
 					  <div style="height: 40px;    margin-top: 20px;" class="progress">
						  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width:%s%%">
						  
						  </div>
					  </div>
                  </div>
              </div>
			  ',$tar_diff*100);
			  
			  ?>

			
		</div>
		
		<div class="row">
			<div class="col-md-9 col-sm-8 portfolio-item">
				<table class="table table-hover" style="    background-color: white;">
					<thead>
					  <tr>
						<th>Date</th>
						<th>Description</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
					<?php
					$selectedGoal_id=$_POST['selectedGoal_id'];
					$stmt = $mysqli -> prepare("SELECT description, date, evaluate_num, up_id FROM updateprog WHERE goal_id=$selectedGoal_id;");
					$stmt->execute();
					$tgdescription=null;
					$tgDate=null;
					$tgNum=null;
					$upId=null;		
					$stmt->bind_result($tgdescription, $tgDate, $tgNum, $upId);
					$stmt->store_result();
					while($stmt->fetch())printf('
					<tr>
					<td><p>%s</p></td>
					<td><p>%s</p></td>
					<td><input style=";" type="text" name="%s" style="width:50px;" value="%s" >
						<input style=";" type="text" name="%s" style="width:50px;" value="%s" >
					<button id="edit_contact" type="button" class="btn btn-info" onclick="pop_Edit()">Edit</button></td>
					
					</tr>',$tgDate, $tgdescription,$tgNum,$tgNum,$upId,$upId);		  
					?>
					</tbody>
				</table>
			</div>
			
      
		
		</div>
		<button id="myBtn" type="button" class="btn btn-primary portfolio-link" onclick="pop_Add()" >ADD UPDATE</button>
        <a href="#" class="btn btn-primary">MARK AS COMPLETE</a>
        <a href="#" class="btn btn-primary">ABANDON GOAL</a>
        	
			<!--create contact modal-->
	
			
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="copyright">Copyright &copy; PeelPal 2017</span>
                    <a href="#page-top" title="To Top" class="page-scroll" style="padding:10px">
                    </a>
                </div>
            </div>
        </div>
    </footer>
       
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
	<script type="text/JavaScript"language="javascript">
	$(function(){
	//create contact modal
    // Get the modal
    

    // When the user clicks the button, open the modal
    // When the user clicks on <span> (x), close the modal
    //var modal = document.getElementById('myModal');
    
    $(edit_contact).click(function() {
        var $contact_id_val = $(this).prev().val();
        //alert($contact_id_val);
        $(edit_contact_Id).val($contact_id_val);
        var $da = $(this).parent().parent().children()[0];
        var $de = $(this).parent().parent().children()[1];
        var $da1 = $da.children;
        var $da11 = $da1[0].innerHTML;
        var $de1 = $de.children;
        var $de11 = $de1[0].innerHTML;
        $(edit_da).val($da11);
        $(edit_de).val($de11);
        var $edit_eve = $(this).prev().prev().val();
        $(edit_num).val($edit_eve);

        
    });
    
	});
	</script>
	
	<script type="text/JavaScript"language="javascript">
	function pop_Add() {
    //create contact modal
    // Get the modal
    var modal = document.getElementById('myModal');
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks the button, open the modal
    modal.style.display = "block";
    
    // When the user clicks on <span> (x), close the modal
    //var modal = document.getElementById('myModal');
	span.onclick = function() {
        var modal = document.getElementById('myModal');
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal ) {
            modal.style.display = "none";
            //edit_modal.style.display = "none";
        }
    }
	}
	</script>
	
	<script type="text/JavaScript"language="javascript">
	function pop_Edit() {
    // Get the modal
    var edit_modal = document.getElementById('edit_myModal');
    // Get the button that opens the modal
    var edit_btn = document.getElementById("edit_contact");
    // Get the <span> element that closes the modal
    var edit_span = document.getElementsByClassName("close")[1];
    // When the user clicks the button, open the modal
    //edit_btn.onclick = function() {
    edit_modal.style.display = "block";
    //}
    // When the user clicks on <span> (x), close the modal
    edit_span.onclick = function() {
        edit_modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == edit_modal) {
            edit_modal.style.display = "none";
            event.cancelBubble = true;

        }
    }
	}
	</script>
    <script src="js/agency.js"></script>

    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>
