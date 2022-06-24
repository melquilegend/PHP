	<!-- Modal -->
		<div class="modal fade" id="<?php echo $mytin; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<?php
		$user_query = mysqli_query($conn,"select * from file where tin_number = '$mytin'")or die(mysqli_error());
		while($row = mysqli_fetch_array($user_query)){
		$myid=$row['file_id'];
		$myfile=$row['file_name'];
		$mytrade=$row['trade_name'];
		$mytype=$row['file_type'];
		$mycategory=$row['file_category'];
		$myblock=$row['block'];
		}?>	
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">EDIT FILE <?php echo $mytin; ?></h4>
			</div>
			
			
			<div class="modal-body">
				 <form  role="form" class="login_form" method="post" action="editfile.php">
					<div class="form-group">
					<input type="hidden" id="" name="myid1" value="<?php echo $myid; ?>" >
					<p>FILE NAME :<input class="input focused" name="file_name1" id="focusedInput" type="text"  value="<?php  echo $myfile; ?>" required></p>
					<p>TRADE NAME:<input class="input focused" name="trade_name1" id="focusedInput" type="text"  value="<?php  echo $mytrade; ?>" ></p>
					<p>TIN NUMBER:<input class="input focused" name="tin_number1" id="focusedInput" type="text"  value="<?php  echo $mytin; ?>" required></p>
					<p>FILE TYPE :		
									<select name="file_type1"  class="" required>
                                     <option value ="individual"> Individual </option>
									<option value ="entity">Entity </option>
                                     </select> </p>
					<p>CATEGORY  :	
									<select name="file_category1"  class="" required>
                                     <option value ="main">Main </option>
									<option value ="audit">Audit </option>
									<option value ="objection"> Objection </option>
									<option value ="examination">Examination </option>
                                     </select> </p>
										
					<p>BLOCK     :	
									<select name="block_name1"  class="" required>
										  <?php
											if ($staff_region =="zanzibar"){ ?>
                                          
                                             	<option value ="north unguja block">North Unguja Block(NUB) </option>
												<option value ="south unguja block">South Unguja Block (SUB) </option>
												<option value ="mjini magharibi block">Mjini Magharibi Block (MMB) </option>
                                               	<option value ="north unguja block">Mlandege Model Block Zanzibar(MMBZ) </option>	
                                            </select>
											<?php }else{ ?>
								
                                             	<option value ="north pemba block">North Pemba Block(NPB) </option>
												<option value ="south pemba block">South Pemba Block (SPB) </option>
	                                           	<option value ="north unguja block">Miembeni Model Block Pemba(MMBP) </option>	
                                            </select>
											<?php } ?></p>

					</div>
					
					<button  type="submit" class="btn btn-success" class="fa fa-save"></i> Update</button>
					</form>
			
			</div>
					
			<div class="modal-footer">
									
				<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
			</div>
			</div>
			
		</div>
		</div>