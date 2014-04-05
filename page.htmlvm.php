<?php
//Check if user is "logged in"
if (!defined('FREEPBX_IS_AUTH')) { 
	die('No direct script access allowed'); 
}
?>
<!--/****************************** html/php code *************************************/-->
      	<head>
              	<title>GUI</title>
                <script type="text/javascript" src="modules/htmlvm/jquery-1.7.2.min.js"></script>
                <script type="text/javascript" src="modules/htmlvm/jquery-ui-1.8.21.custom.min.js"></script>
		
	</head>
		<h3>HTML Voicemail Template</h3>


 	<?php


                        //get the script file
                        $file = basename("/etc/asterisk/sendvm.php");
                        $alltext = file_get_contents("/etc/asterisk/sendvm.php");

                        preg_match("/\/\/f1(.*)\/\/f2/s",$alltext,$from1);
                        preg_match("/\/\/n1(.*)\/\/n2/s",$alltext,$fromname1);
                        preg_match("/\/\/h1(.*)\/\/h2/s",$alltext,$host1);
                        preg_match("/\/\/u1(.*)\/\/u2/s",$alltext,$username1);
                        preg_match("/\/\/p1(.*)\/\/p2/s",$alltext,$password1);
                        preg_match("/\/\/o1(.*)\/\/o2/s",$alltext,$port1);
                        preg_match("/\/\/s1(.*)\/\/s2/s",$alltext,$subject1);
			
			$from=str_replace("\"","",$from1[1]);
			$from=str_replace(";","",$from);
			$fromname=str_replace("\"","",$fromname1[1]);
			$fromname=str_replace(";","",$fromname);
			$host=str_replace("\"","",$host1[1]);
			$host=str_replace(";","",$host);
			$username=str_replace("\"","",$username1[1]);
			$username=str_replace(";","",$username);
			$password=str_replace("\"","",$password1[1]);
			$password=str_replace(";","",$password);
			$port=str_replace("\"","",$port1[1]);
			$port=str_replace(";","",$port);
			$subject=str_replace("\"","",$subject1[1]);
			$subject=str_replace(";","",$subject);
			

	?>

	<!--another failed box-->
	<!--<div id="sysinfo-right">
		<div id="sett" class="infobox ui-widget-content  ui-corner-all" style='display:table-cell'>-->
			<h3 class="ui-widget-header ui-state-default ui-corner-all">Email Settings</h3>
			<input type="checkbox" id="settings" /><label for="settings" id="lsettings">Show Settings</label>
			<br><br>

			<!--the form with the data-->
				<table align=left>
					<tr><td><label for="from" id="lfrom">From: </label></td><td><input placeholder="myemail@mydomain.com" type="text" id="from" name="from" value="<?php echo $from; ?>"/><? echo $errors1; ?></td></tr>
					<tr><td><label for="fromname" id="lfromname">FromName: </label></td><td><input placeholder="My Company Name" type="text" id="fromname" name="fromname" value="<?php echo $fromname; ?>"/><? echo $errors1; ?></td></tr>
					<tr><td><label for="host" id="lhost">Host: </label></td><td><input placeholder="ssl://smtp.gmail.com" type="text" id="host" name="host" value="<?php echo $host; ?>"/><? echo $errors1; ?></td></tr>
					<tr><td><label for="username" id="lusername">UserName: </label></td><td><input placeholder="myemail@mydomain.com" type="text" id="username" name="username" value="<?php echo $username; ?>"/><? echo $errors1; ?></td></tr>
					<tr><td><label for="password" id="lpwd">Password: </label></td><td><input placeholder="mypassword" type="text" id="password" name="password" value="<?php echo $password; ?>"/><? echo $errors1; ?></td></tr>
					<tr><td><label for="port" id="lport">Port: </label></td><td><input placeholder="465" type="text" id="port" name="port" value="<?php echo $port; ?>"/><? echo $errors1; ?></td></tr>
					<tr><td><label for="subject" id="lsubject">Subject: </label></td><td><input placeholder="[VM]: New VM" type="text" id="subject" name="subject" value="<?php echo $subject; ?>"/><? echo $errors1; ?></td></tr>
				</table>
				<button id="savemail" class="ui-state-error">Save Settings</button>
				<div id="note">
					<p style="font-size:10px">
						This Module Use the PHP class PHPMAILER in order to send the email you need to fill all fields with your email credetendials.<br><br>
					</p>
					 <p style="font-size:11px">
						Go to Menu Settings--->SubMenu Voicemail Admin--->Tab Settings<br>
							Change <b><i>emailbody</i></b>  to: ${VM_NAME}|${VM_MAILBOX}|${VM_DUR}|${VM_CALLERID}|${VM_DATE}<br>
							Change <b><i>mailcmd</i></b>  to: /etc/asterisk/sendvm.php<br><br>
						<b>
							This is important if you want to receive the VM Notifications in HTML format
						</b> 
						
					</p>
				</div>

			<script>
				/****** On load hide the items **********/
				$("#from").hide();
				$("#fromname").hide();
				$("#host").hide();
				$("#username").hide();
				$("#password").hide();
				$("#port").hide();
				$("#password").hide();
				$("#subject").hide();
				$("#lfrom").hide();
				$("#lfromname").hide();
				$("#lusername").hide();
				$("#lhost").hide();
				$("#lpwd").hide();
				$("#lport").hide();
				$("#lsubject").hide();
				$("#savemail").hide();
				$("#note").hide();

				/********** if change the check box hide or show *************/
				$("#settings").click(function(){
					if($(this).is(":checked")){
				
						$("#from").show();
						$("#fromname").show();
						$("#host").show();
						$("#username").show();
						$("#password").show();
						$("#port").show();
						$("#password").show();
						$("#subject").show();
						$("#lfrom").show();
						$("#lfromname").show();
						$("#lusername").show();
						$("#lhost").show();
						$("#lpwd").show();
						$("#lport").show();
						$("#lsubject").show();
						$("#savemail").show();
						$("#note").show();



					}else{

						$("#from").hide();
						$("#fromname").hide();
						$("#host").hide();
						$("#username").hide();
						$("#password").hide();
						$("#port").hide();
						$("#password").hide();
						$("#subject").hide();
						$("#lfrom").hide();
						$("#lfromname").hide();
						$("#lusername").hide();
						$("#lhost").hide();
						$("#lpwd").hide();
						$("#lport").hide();
						$("#lsubject").hide();
						$("#savemail").hide();
						$("#note").hide();
					}							
				});



				 	$('#savemail').click(function(){
                                                        $.ajax({
                                                               	type: 'POST',
                                                               	url: 'modules/htmlvm/mailset.php',
                                                               	data: {
									from: $('#from').val(), 
									fromname: $('#fromname').val(),
									host: $('#host').val(), 
									username: $('#username').val(), 
									pwd: $('#password').val(), 
									port: $('#port').val(), 
									subject: $('#subject').val() 
									},
                                                               	success: function(data){
                                                                        if ( data == 0 ){
                                                                                alert('All Data Required');
                                                                       	}else{
                                                                                window.top.location.reload();
                                                                                alert('Mail Settings Saved');

                                                                        }
                                                                }

                                                        });
                                                });





			</script>
		<!--</div>
	</div>-->



   	<!--<div id="sysinfo-left" class="infobox ui-widget-content  ui-corner-all" >-->
		<br><br><br><br><br><br><br><br><br>
                <label><b>Your current Template</b></label>
                <a href="#" class="info">
                        <span>
				Here you can see your current VM template. <p style="font-size:10px;">Ignore the Quotes and the Semicolon</p>
                        </span>
                </a><hr>

		<?php


			//get the script file
		        $file = basename("/etc/asterisk/sendvm.php");
		        $text = file_get_contents("/etc/asterisk/sendvm.php");

			preg_match("/\/\/b1(.*)\/\/b2/s",$text,$body); 

			echo $body[1];
			

		?>

		<br><br>
		<label><b>Change your template here:</b></label>
		<a href="#" class="info">
			<span>				
				Create the HTML code to deliver your VM messages.<br><br>
				In the text area insert your HTML Code, to preview the code press the button "Preview".<br><br>
				When you are happy with the look of your template press the button "Save Template", The next time you will receive a VM Notification with the new HTML template.<br><br>
				You can use the following variables:
				<ul>
					<li>${name}: The owner of the mailbox.</li>
					<li>${mailbox}: The mailbox number.</li>
					<li>${dur}: The Duration of the Voicemail.</li>
					<li>${cid}: The Caller ID of the caller.</li>
					<li>${date}: The date of the received Voicemail.</li>
				</ul>
			</span>
		</a>

		<hr>
		<textarea id="code" cols="72" rows="15"></textarea><br>
		<button id="send">Preview</button>
		<button id="savetem">Save template</button>

	<script>
                              $('#savetem').click(function(){
                                                        $.ajax({
                                                                type: 'POST',
                                                                url: 'modules/htmlvm/echo.php',
                                                                data: { val: $('#code').val() },
                                                                success: function(data){
                                                                        if ( data == 0 ){
                                                                                alert('Cannot Save Empty Data');
                                                                        }else{
										window.top.location.reload();
                                                                                alert('Template Saved');
										
                                                                        }
                                                                }

                                                        });
                                                });                                        
	</script>


	<script type="text/javascript">
		$("#send").click(function(){//begin click
                        $("#frame").html("");
                        $("#frame").html( "Here is the preview of your code:<hr>" + $("#code").val() );

                });//end click

	</script>

	<br><br><br>
	<div id="frame">
		Preview will show here:<hr>
	</div>
	
	<!--</div>-->


