						<?php
						$name = $_POST['name'];
						$visitor_email = $_POST['email'];
						$message = $_POST['message'];
						$email_from = '$visitor_email';
						$email_subject = "Findmywarehouse.com Form Submission";
						$email_body = "You have received a new message from the user $name.\n".
												"Here is the message:\n $message".
						$to = "mscheess@purdue.edu";
						$headers = "From: $email_from \r\n";
						$headers .= "Reply-To: $visitor_email \r\n";
						mail($to,$email_subject,$email_body,$headers);
						?>
						
						<META HTTP-EQUIV="Refresh" CONTENT="0;URL=contact_us.php">