<?php
class continueLevelApp{
	public function continueapp($array){
		// print_r($array);
		
		$level=$array['level'];
		
		if($level==1){
			$this->step2($array);//school result
		}
		elseif($level==2){
			$this->step3($array);//personal details
		}
		elseif($level==3){
			$this->step4($array);//study choice
		}
		elseif($level==4){
			$this->step5($array);//Domicilium Address
		}
		elseif($level==5){
			$this->step6($array);//Residental Address
		}
		elseif($level==6){
			$this->step7($array);//postal Address
		}
		elseif($level==7){
			$this->step8($array);//contact details
		}
		elseif($level==8){
			$this->step9($array);//Demographic details
		}
		elseif($level==9){
			$this->step10($array);//next of kin
		}
		elseif($level==10){
			$this->step11($array);//emegency contact
		}
		elseif($level==11){
			$this->step12($array);//current activity
		}
		elseif($level==12){
			$this->step13($array);//secondary EEducation
		}
		elseif($level==13){
			$this->step14($array);//Tertiary Education
		}
		elseif($level==14){
			$this->step15($array);//Indemnity & undertaking
		}
		elseif($level==15){
			$this->step16($array);//payment
		}
		elseif($level==16){
			$this->step17($array);//Documents
		}
		elseif($level==17){
			$this->step18($array);//submit
		}
	}
	protected function step2($array){
		global $conn;
		?>
		<style>
		</style>
			<div class="step2">
				<div class="headerWarner">
					<h2>Personal Details(Step:2)</h2>
				</div>
				<div class="personalDetails">
					<div class="info flex">
						<div class="div"><h6>South African?</h6></div>
						<div class="div2">
							<select id="sa">
								<option value="">-- --</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="foreign flex" hidden>
						<div class="text">Passport Number : </div>
						<div class="input_mac">
							<input style="background-color:#212121;" type="text" id="passport" placeholder="Enter Passport Number" required="">
						</div>
					</div>
					<div class="southafrican flex" hidden> 
						<div class="text">SA ID Number : </div>
						<div class="input_mac">
							<input style="background-color:#212121;" type="number" maxlength="13" minlength="13" id="idNumber" placeholder="Enter SA ID Number" required="">
						</div>
					</div>
					<div class="errorMessage" hidden ></div>
				</div>
				<hr>
				<div class="headerWarner">
					<h2>Continue(Step:2)..</h2>
				</div>

				<div class="personalDetails">
					<div class="info1">
						<div class="myPerso flex">
							<div class="left">Gender</div>
							<div class="right"><select id="gender" required><option value=""> -- Please Select -- </option><option value="male">Male</option><option value="Female">Female</option></select></div>
						</div>
						<div id="errorgender" hidden></div>
						<div class="myPerso flex">
							<div class="left">Date Of Birth</div>
							<div class="right"><input type="date" id="dob" required="" placeholder="date of birth"></div>
						</div>
						<div id="errordob" hidden></div>
						<div class="myPerso flex">
							<div class="left">title</div>
							<div class="right"><select id="title" required=""><option value=""> -- Please select -- </option><option value="Mr"> Mr</option><option value="Mrs"> Mrs</option><option value="Dr"> Dr</option><option value="Ms"> Ms</option><option value="Prof"> Prof</option><option value="Miss"> Miss</option></select></div>
						</div>
						<div id="errortitle" hidden></div>
						<div class="myPerso flex">
							<div class="left">initials</div>
							<div class="right"><input type="text" id="initials" required="" placeholder="Enter Initials"></div>
						</div>
						<div id="errorinitials" hidden></div>
						<div class="myPerso flex">
							<div class="left">Surname</div>
							<div class="right"><input type="text" id="lname" required="" placeholder="Enter Surname"></div>
						</div>
						<div id="errorlname" hidden></div>
						<div class="myPerso flex">
							<div class="left">First Name</div>
							<div class="right"><input type="text" id="fname" required="" placeholder="Enter First Name"></div>
						</div>
						<div id="errorfname" hidden></div>
						<div class="myPerso flex">
							<div class="left">Marital Status</div>
							<div class="right"><select id="status" required><option value=""> -- Please Select -- </option><option value="married">Married</option><option value="divorced">Divorced</option><option value="divorced">Single</option></select></div>
						</div>
						<div id="errorstatus" hidden></div>
						<div class="myPerso flex">
							<div class="left">Home Language</div>
							<div class="right"><select id="hlang" required><option value=""> -- Please Select--</option><?php $this->getAllLanguages();?></select></div>
						</div>
						<div id="errorhlang" hidden></div>
						<div class="myPerso flex">
							<div class="left">Ethnic Group</div>
							<div class="right"><select id="EthnicGroup" required><option value=""> -- Please Select</option><option value="black">Black</option><option value="white">White</option><option value="coloured">Coloured</option><option value="other">Other</option></select></div>
						</div>
						<div id="errorEthnicGroup" hidden></div>
						<div class="myPerso flex">
							<div class="left">Are You Employed?</div>
							<div class="right"><select id="Employed" required><option value=""> -- Please Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>
						</div>
						<div id="errorEmployed" hidden></div>
						<div class="myPerso flex">
							<div class="left">Where did you hear about us?</div>
							<div class="right"><select id="hear" required><option value="netchatsa"> Netchatsa</option></select></div>
						</div>
						<div id="errorhear" hidden></div>
						<div class="myPerso flex">
							<div class="left">Is Bursary Required</div>
							<div class="right"><select id="bursary" required><option value=""> -- Please Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>
						</div>
						<div id="errorbursary" hidden></div>
						
					</div>
				</div>
				<hr>
				<!-- <button id="do">dlknjn</button> -->
				<div class="personalDetails">
					<div class="info1">
						<button id="_1_" type="submit" class="btn btnn">Submit</button>
					</div>


				</div>
				<div class="errorCatch2" hidden></div>
			</div>
		<?php
	}
	protected function getAllPostalCodes(){
		global $conn;
		$_=$conn->query("select*from postaldb");
		while($row=mysqli_fetch_array($_)){
			$a=$row["suburb"]." : ".$row['code'];
			?>
			<option value="<?php echo $a;?>"><?php echo $a;?></option>
			<?php
		}
	}
	protected function getAllLanguages(){
		global $conn;
		$_=$conn->query("select*from languages");
		while($row=mysqli_fetch_array($_)){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['lang'];?></option>
			<?php
		}
	}
	protected function step3($array){
		global $conn;
		?>
		<style>

		</style>
		<div class="step2"><!--step 3-->
			<div class="headerWarner">
				<h2>Residental Information(Step:3/17)</h2>
			</div>
			<hr>
			
			<div class="personalDetails">
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Street Name</div>
						<div class="right"><input type="address" id="street" placeholder="Enter Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">Suburb Name</div>
						<div class="right"><input type="address" id="suburb" required="" placeholder="Enter Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">Town Name</div>
						<div class="right"><input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">Province Name</div>
						<div class="right">
						    <select id="province" required="" placeholder="Enter Province Name">
						        <option value=""> -- Select Province -- </option>
						        <option value="KwaZulu-Natal"> KwaZulu-Natal </option>
						        <option value="Western Cape"> Western Cape </option>
						        <option value="Northen Cape"> Northen Cape </option>
						        <option value="North West"> North West </option>
						        <option value="Limpopo"> Limpopo </option>
						        <option value="Mpumalanga"> Mpumalanga </option>
						        <option value="Free States"> Free States </option>
						        <option value="Gauteng"> Gauteng </option>
						        <option value="Eastern Cape"> Eastern Cape </option>
						    </select>
					    </div>
					</div>
					<div id="errorprovince" hidden></div>
					<div class="myPerso flex">
						<div class="left">Postal Code</div>
						<div class="right"><select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->getAllPostalCodes();?></select></div>
						
					</div>
					<h6 style='color:red;'>Can't find your Postal? Send us your proof of resident via WhatsApp(068 515 3023) so we can fix Error.</h6>
					<div id="errorpostal" hidden></div>	
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Contact Details</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Phone Number</div>
						<div class="right"><input type="number" id="phone" placeholder="Enter Cell Phone Number"></div>
					</div>
					<div id="errorphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Telephone</div>
						<div class="right"><input type="number" id="telephone" placeholder="Enter Telephone Number"></div>
					</div>
					<div id="errortelephone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Email Address</div>
						<div class="right"><input type="email" id="email" placeholder="Enter Email Address"></div>
					</div>
					<div id="errortelephone" hidden></div>
					
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Disability & Residents information</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Do you want to apply for Resident?</div>
						<div class="right flex"><select id="res" required=""><option value="">-- select item -- </option><option value="yes">Yes</option><option value="no">No</option></select></div>
					</div>
					<div id="errorres" hidden></div>
					<div class="myPerso flex">
						<div class="left">Do you have Disabilities/impairment?</div>
						<div class="right flex"><select id="dis" required=""><option value="">-- select item -- </option><option value="yes">Yes</option><option value="no">No</option></select></div>
					</div>
					<div id="errordis" hidden></div>
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<div class="info1">
					<button id="_3_" type="submit" class="btn">Submit</button>
				</div>
			</div>
			<div class="errorCatch3" hidden></div>
		</div>
		<?php
		
	}
	protected function step4($array){
		global $conn;
		?>
		<div class="step2"><!--step 4-->
			<div class="headerWarner">
				<h2>Guardian Details(Step:4/17)</h2>
			</div>
			<hr>
			
			<div class="personalDetails">
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Guardian First Name`s</div>
						<div class="right"><input type="text" id="fname" placeholder="Enter Guardian First Name"></div>
					</div>
					<div id="errorfname" hidden></div>
					<div class="myPerso flex">
						<div class="left">Guardian Last Name</div>
						<div class="right"><input type="text" id="lname" required="" placeholder="Enter Guardian Last Name"></div>
					</div>
					<div id="errorlname" hidden></div>
					<div class="myPerso flex">
						<div class="left">Relationship</div>
						<div class="right"><select id="relationship" required=""><option value="">-- Select Option --</option><option value="Mother">Mother</option><option value="Father">Father</option><option value="Aunty">Aunty</option><option value="Uncle">Uncle</option><option value="Gogo">Gogo</option><option value="Mkhulu">Mkhulu</option></select></div>
					</div>
					<div id="errorrelationship" hidden></div>
					<div class="myPerso flex">
						<div class="left">Guardian is Employed?</div>
						<div class="right"><select id="employed" required=""><option value="">-- Select Option --</option><option value="Yes">Yes</option><option value="No">No</option></select></div>
					</div>
					<div id="erroremployed" hidden></div>	
					<div class="myPerso flex">
						<div class="left">Phone Number</div>
						<div class="right"><input type="number" id="phone" required="" placeholder="Enter Phone Number" maxlength="10" minlength="10"></div>
					</div>
					<div id="errorphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Altenative Phone Number</div>
						<div class="right"><input type="number" id="alphone" required="" placeholder="Enter Altenative Phone Number" maxlength="10" minlength="10"></div>
					</div>
					<div id="erroralphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Email Address</div>
						<div class="right"><input type="email" id="email" required="" placeholder="Enter email address" ></div>
					</div>
					<div id="erroremail" hidden></div>
					
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Guardian Postal Address</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Street Name</div>
						<div class="right"><input type="address" id="street" placeholder="Enter Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">Suburb Name</div>
						<div class="right"><input type="address" id="suburb" required="" placeholder="Enter Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">Town Name</div>
						<div class="right"><input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">Province Name</div>
						
						<div class="right">
						     <select id="province" required="" placeholder="Enter Province Name">
						        <option value=""> -- Select Province -- </option>
						        <option value="KwaZulu-Natal"> KwaZulu-Natal </option>
						        <option value="Western Cape"> Western Cape </option>
						        <option value="Northen Cape"> Northen Cape </option>
						        <option value="North West"> North West </option>
						        <option value="Limpopo"> Limpopo </option>
						        <option value="Mpumalanga"> Mpumalanga </option>
						        <option value="Free States"> Free States </option>
						        <option value="Gauteng"> Gauteng </option>
						        <option value="Eastern Cape"> Eastern Cape </option>
						    </select>
						</div>
					</div>
					<div id="errorprovince" hidden></div>
					<div class="myPerso flex">
						<div class="left">Postal Code</div>
						<div class="right"><select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->getAllPostalCodes();?></select></div>
						
					</div>
					<h6 style='color:red;'>Can't find your Postal? Send us your proof of resident via WhatsApp(068 515 3023) so we can fix Error.</h6>
					<div id="errorpostal" hidden></div>	
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<div class="info1">
					<button id="_4_" type="submit" class="btn">Submitd</button>
				</div>
			</div>
			<div class="errorCatch4" hidden></div>
		</div>
		<?php
	}
	protected function step5($array){
		global $conn;
		?>
		<div class="step2"><!--step 3-->
			<div class="headerWarner">
				<h2>High School Details(Step:5/17)</h2>
			</div>
			<hr>
			
			<div class="personalDetails">
				<h2>School Address Details</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">School Name</div>
						<div class="right">
							<select id="schoolname" required><option value=""> -- Select School -- </option><?php $this->getAllSchools();?></select>
						</div>
					</div>
					<div id="errorschoolname" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Street Name</div>
						<div class="right"><input type="address" id="street" placeholder="Enter Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Suburb Name</div>
						<div class="right"><input type="address" id="suburb" required="" placeholder="Enter Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Town Name</div>
						<div class="right"><input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Province Name</div>
						<div class="right">
						     <select id="province" required="" placeholder="Enter Province Name">
						        <option value=""> -- Select Province -- </option>
						        <option value="KwaZulu-Natal"> KwaZulu-Natal </option>
						        <option value="Western Cape"> Western Cape </option>
						        <option value="Northen Cape"> Northen Cape </option>
						        <option value="North West"> North West </option>
						        <option value="Limpopo"> Limpopo </option>
						        <option value="Mpumalanga"> Mpumalanga </option>
						        <option value="Free States"> Free States </option>
						        <option value="Gauteng"> Gauteng </option>
						        <option value="Eastern Cape"> Eastern Cape </option>
						    </select>
						 </div>
					</div>
					<div id="errorprovince" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Postal Code</div>
						<div class="right"><select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->getAllPostalCodes();?></select></div>
						
					</div>
					<h6 style='color:red;'>Can't find your Postal? Send us your proof of resident via WhatsApp(068 515 3023) so we can fix Error.</h6>
					<div id="errorpostal" hidden></div>		
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>School Details (cont)...</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Completion Year</div>
						<div class="right"><select id="yearcompleted" required=""><option value="">-- Select Year -- </option><?php $this->yearCompleted();?></select></div>
					</div>
					<div id="erroryearcompleted" hidden></div>
					<div class="myPerso flex">
						<div class="left">Current Activity</div>
						<div class="right"><select id="activity" required=""><option value="">-- Select Option --</option><option value="Mother">Mother</option><option value="Studying">Studying</option><option value="Working">Working</option><option value="Gap Year">Gap Year</option><option value="Attending Court Case">Attending Court Case</option><option value="College">College</option><option value="Universiy">Universiy</option></select></div>
					</div>
					<div id="erroractivity" hidden></div>
					<div class="myPerso flex">
						<div class="left">Any Tertiary Education History?</div>
						<div class="right"><select id="eduhistory" required=""><option value="">-- Select Option --</option><option value="Yes">Yes</option><option value="No">No</option></select></div>
					</div>
					<div id="erroreduhistory" hidden></div>
					<!-- < -->
					<div class="myPerso flex" id="ExtraEdit" hidden>
						<div class="left">University</div>
						<div class="right"><input type="text" id="uni" placeholder="Enter University Studied At"></div>
					</div>
					<div id="erroruni" hidden></div>
					<div class="myPerso flex"  id="ExtraEdit1" hidden>
						<div class="left">Student Number</div>
						<div class="right"><input type="number" id="studentnumber" placeholder="Enter Student Number"></div>
					</div>
					<div id="errorstudentnumber" hidden></div>
					<div class="myPerso flex"  id="ExtraEdit2" hidden>
						<div class="left">Completion Status</div>
						<div class="right"><select id="statuscompletion" required=""><option value="">-- Select Option --</option><option value="Completed">Completed</option><option value="Studied: Final Year">Studied: Final Year</option><option value="Studied: Second Year">Studied: Second Year</option><option value="Studied: First Year">Studied: First Year</option><option value="Dropped Out">Dropped Out</option><option value="Expelled/Dismissed">Expelled/Dismissed</option><option value="Financial Excluded">Financial Excluded</option></select></div>
					</div>
					<div id="errorstatuscompletion" hidden></div>	
					<!-- < -->
				</div>
			</div>
			<hr>
			<!--  -->
			<div class="personalDetails">
				<div class="info1">
					<button id="_5_" type="submit" class="btn">Submit</button>
				</div>
			</div>
			<div class="errorCatch5" hidden></div>
		</div>
		<?php
	}
	protected function step6($array){
		global $conn;
		$t=false;
		?>
		<div class="step2"><!--step 3-->
			<div class="headerWarner">
				<h2>Documents Upload(Step:6/17)</h2>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Upload Documents(<span style="color:red;">.PDF<small>format only</small></span>)</h2>
				<div class="info1">
					<div class="myPerso " id="_1">
						<div class="left">Certified ID Copy</div>
						<div class="right" id="_1_1">
							<?php  if($this->isUploaded1($array)){
								?>
									<h5 style="color:green;">FILE_ALREADY_UPLOADED.</h5>
									<script>
										$(document).ready(function(){
											$("#_2").removeAttr("hidden");
										});
										
									</script>
								<?php
								$t=true;
							}
							else{
								?>
									<input type="file" id="idcopy" name="file" required="" placeholder="upload Your ID Copy">
						</div>
								<?php
							}
							?>
					</div>

					<div id="erroridcopy" hidden></div>
					<div class="myPerso " id="_2" hidden>

						<div class="left">Certified Grade11/Matric Final Results</div>
						<div class="right" id="_2_2">
							<?php if($this->isUploaded2($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									<script>
										$(document).ready(function(){
											$("#_3").removeAttr("hidden");
										});
										
									</script>
								<?php
							}
							else{
								?>
									<input type="file" id="finalresults" name="file" required="" placeholder="Upload Results"></div>
								<?php
							}
							?>
						
					</div>
					<div id="errorfinalresults" hidden></div>
					<div class="myPerso " id="_3" hidden>
						<div class="left">Certified Proof Of Resident</div>
						<div class="right" id="_3_3">
							<?php if($this->isUploaded3($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									<script>
										$(document).ready(function(){
											$("#_4").removeAttr("hidden");
										});
										
									</script>
								<?php
							}
							else{
								?>
									<input type="file" id="proofresident" name="file" required="" placeholder="Upload Proof Of Resident"></div>
								<?php
							}
							?>
					</div>
					<div id="errorproofresident" hidden></div>
					<div class="myPerso" id="_4" hidden>
						<div class="left">Certified Guardian ID Copy</div>
						<div class="right" id="_4_4">
							<?php if($this->isUploaded4($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									
								<?php
							}
							else{
								?>
									<input type="file" id="guardianid" name="file" required="" placeholder="Guardian Coppy"></div>
								<?php
							}
							?>
					</div>
					<div id="errorguardianid" hidden></div>
				</div>
			</div>
			<hr>
			<div class="personalDetails" id="_submitFiles" hidden="">
				<div class="info1">
					<button id="_submit_" type="submit" class="btn">Submit</button>
				</div>
			</div>
			<div class="errorCatch5" hidden></div>
		</div>

		<?php
	}
	protected function step7($array){
		global $conn;
		?>
		<style>
			.container .collapse .match{
				margin-top: 2%;
			}
		</style>
		<?php
			$_=$conn->query("select*from universities order by rand() ");
			while($row=mysqli_fetch_array($_)){
				$uni_id=$row["id"];
				$uni_name=$row['uni_name'];
				?>
					<div class="container" style="width:100%;margin-top:-10;padding:10px;">
					  <button type="button" style="width:100%;padding: 10px 0;" class="btn btn-info" data-toggle="collapse" data-target="<?php echo "#_".$uni_id;?>"><?php echo $uni_name; ?></button>
					  <div id="<?php echo "_".$uni_id;?>" class="collapse">
							<div class="container match">
								<?php 
								$this->getAllFaculties($uni_id,$uni_name,$array);
								?>
							</div>
					  </div>
					</div>

				<?php
			}
		
	}
	protected function getAllFaculties($uni_id,$uni_name,$array){
		global $conn;
		
		$_1=$conn->query("select*from faculties where uni_id='$uni_id'");
		if($_1->num_rows==0){
			echo "<h5 style='color:red;'>No faculties Available for ".$uni_name."</h5";
		}
		else{
			while($row=mysqli_fetch_array($_1)){
				$faculty_id=$row['faculty_id'];
				$faculty_name=$row["faculty_name"];
				?>
				<button style="width:100%;margin-top:2%;background-color:green;overflow-wrap: break-word;word-wrap: break-word;hyphens: auto;" type="button" class="btn btn-info" data-toggle="collapse" data-target="<?php echo "#_".$faculty_id;?>"><?php echo $faculty_name;?></button>
				<div id="<?php echo "_".$faculty_id;?>" class="collapse">
					<div class="container match" style="width:100%;padding: 5px 0;">
					  <?php
					  $this->courses($uni_id,$uni_name,$faculty_id,$faculty_name,$array);
					  ?>
					</div>
				</div>
				<?php
			}
		}
		
	}
	protected function courses($uni_id,$uni_name,$faculty_id,$faculty_name,$array){
		global $conn;
		?>
		<style>
			.collapse .container .all_combine .left{
				width: 48%;
				padding: 5px;

			}
			.collapse .container .all_combine .right{
				width: 52%;
				padding: 5px;

			}
			.collapse .container .all_combine .left .itm{
				width: 100%;
				padding: 5px 0;
			}
			.collapse .container .all_combine .right .item{
				width: 100%;
				padding: 5px 0;
			}

		</style>
		<?php
		$_1=$conn->query("select*from courses where uni_id='$uni_id' AND faculty_id='$faculty_id'");
		if($_1->num_rows==0){
			echo "<h5 style='color:red;'>No Courses Available for Faculty of ".$faculty_name." @ ".$uni_name.",</h5";
		}
		else{
			while($row=mysqli_fetch_array($_1)){
				$course_id=$row['course_id'];
				$course_name=$row["course_name"];
				if($this->issAlreadyApplied($course_id,$this->getApplicationId($array['my_id']))){?>
					<button type="button" class="btn btn-info" data-toggle="collapse" style="width:100%;padding:3px;margin-top:2%;" data-target="<?php echo "#_".$course_id;?>" ><?php echo $course_name;?></button>
					<div id="<?php echo "_".$course_id;?>" class="collapse" style='padding: 10px 0;'>
						<div class="container match" style="width:100%; background-color: #f3f3;color:#000;border-radius: 10px; padding:10px 0;">
							<h2 style="color:#f3f3f3;background-color:navy;">YOU ALREADY HAVE APPLIED FOR <?php echo $course_name;?></h2>	
						</div>
						
					</div>
					<?php

				}
				else{
					?>
					<button type="button" class="btn btn-info" data-toggle="collapse" style="width:100%;padding:3px;margin-top:2%;" data-target="<?php echo "#_".$course_id;?>" ><?php echo $course_name;?></button>
					<div id="<?php echo "_".$course_id;?>" class="collapse" style='padding: 10px 0;'>
						<div class="container match" style="width:100%; background-color: #f3f3;color:#000;border-radius: 10px; padding:10px 0;">
							<h4>Conduct Application For : <?php echo $course_name;?></h4>
						  	<div class="all_combine flex">
						  		<div class="left" id="#<?php echo "_".$course_id;?>">
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Academic Program</h4>
						  			</div>
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Mode Of Attendance</h4>
						  			</div>
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Year Of Study</h4>
						  			</div>
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Campus</h4>
						  			</div>
						  		</div>
						  		<div class="right <?php echo "_".$course_id;?>" >
						  			<div class="item">
						  				<select id="course_name">
						  					<option value="<?php echo $course_id;?>"><?php echo $course_name;?></option>
						  				</select>
						  			</div>
						  			<div class="item">
						  				<select id="mode_of_attendance">
						  					<option value="Full Time">Full Time</option>
						  					<option value="Part Time">Part Time</option>
						  				</select>
						  			</div>
						  			<div class="item">
						  				<select id="year_of_study">
						  					<option value="1st Year">1st Year</option>
						  					<option value="2nd Year">2nd Year</option>
						  				</select>
						  			</div>
						  			<div class="item">
						  				<select id="campus_id">
						  				    
						  					<?php $this->studyCampus($course_id);?>
						  				</select>
						  			</div>
						  			
						  		</div>
						  	</div>
						  	<button type="button" class="btn btn-info <?php echo $course_id;?>" style="background-color: navy;width:90%;">Apply For this Course</button>
						</div>
						<div class="<?php echo "error".$course_id;?>" hidden></div>
					</div>
					<script>
						$(document).ready(function(){
							const id="<?php echo ".".$course_id;?>";
							const error="<?php echo "error".$course_id;?>";

							$(id).click(function(){
								$(id).html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Analysing Data...</span></small>");
								const uni_id="<?php echo $uni_id ?>";
								const uni_name="<?php echo $uni_id ?>";
								const faculty_id="<?php echo $faculty_id ?>";
								const faculty_name="<?php echo $faculty_name ?>";
								const course_id="<?php echo $course_id ?>";
								const course_name=$("#course_name").val();
								const mode_of_attendance=$("#mode_of_attendance").val();
								const year_of_study=$("#year_of_study").val();
								const campus_id=$("#campus_id").val();
								$(id).html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Processing Data...</span></small>");
								$.ajax({
									url:"controler/upload.php?step=6",
									type:"POST",
									data:{uni_id:uni_id,uni_name:uni_name,faculty_id:faculty_id,faculty_name:faculty_name,course_id:course_id,course_name:course_name,mode_of_attendance:mode_of_attendance,year_of_study:year_of_study,campus_id:campus_id
									},
									cache:false,
									beforeSend:function(){
										$(id).html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting Data...</span></small>");
									},
									success:function(e){
										console.log(e.length);
										if(e.length>2){
											$(id).html("ERROR: REPORT THIS ERROR :"+e);
											$(id).attr("style","color:red;background-color:#000;");
											$(error).removeAttr("hidden");
											$(error).attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
											$(error).html("REPORT THIS ERROR <br>Error 320 : "+e);
										}

										else{
											if(e.length<2){
												$(id).html("Application Submitted!!");
												$(id).attr("disabled",true);
												$(id).html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Redirecting...</span></small>");
												window.location=("./?_=apply");
											}
											else{
												$(id).html("Application Submitted!!");
												$("#_"+id).attr("hidden",true);//left
												$("._"+id).attr("hidden",true);//right
												$("#_"+id).attr("disabled",true);//left
												$("._"+id).attr("disabled",true);//right
												$("#course_name").attr("disabled",true);
												$("#mode_of_attendance").attr("disabled",true);
												$("#year_of_study").attr("disabled",true);
												$("#campus_id").attr("disabled",true);
												$(id).attr("disabled",true);
											}
												
										}
									}
								});
							});
						});
						
					</script>
					<?php
				}
					
			}
		}
	}
	protected function issAlreadyApplied($course_id,$applicationid){
		global $conn;
		$_=$conn->query("select course_id,applicationid from finalapplication where applicationid='$applicationid' AND course_id='$course_id'");
		return ($_->num_rows==1);
	}
	protected function studyCampus($course_id){
		global $conn;
		$_=mysqli_fetch_array($conn->query("select*from courses where course_id='$course_id'"));
		$campus_id=$_['campus_id'];
		$_=$conn->query("select*from studycampus where campus_id='$campus_id'");
		if($_->num_rows==0){
			?>
				<option value="Current University">No Campus Found For this Course</option>
			<?php
		}
		else{
			while($row=mysqli_fetch_array($_)){
				$campus_name=$row['campus_name'];
				$campus_id=$row['campus_id'];
				?>
				<option value="<?php echo $campus_id;?>"> <?php echo $campus_name;?></option>
				<?php
			}
		}
	}
	protected function step8($array){
		global $conn;
		?>
		<style>
			.contract{
				border-radius: 10px;
				width: 100%;
				height: 73vh;
				border: 1px solid #ddd;
				overflow-x:auto;
		        overflow-wrap: break-word;
		        word-wrap: break-word;
		        hyphens: auto;
			}
			.optionaln{
				width: 100%;
				/*border: 1px solid red;*/
			}
			.optionaln .flat{
				width: 100%;
				/*border: 1px solid blue;*/
			}
			.optionaln .flat select{
				width: 20%;
			}
			.btn{
				background-color: navy;
				color: #f3f3f3;
				width: 20%;
				margin-top: 2%;
			}
			.btn:hover{
				background-color: forestgreen;
				color: #f3f3f3;
			}
		</style>
		<div class="contract">
		    
			<h2 style="color:blue;">CONSENT TO COLLECT AND PROCESS PERSONAL INFORMATION (POPI)</h2>
            <p><span style="color:green;">I, the undersigned applicant (duly assisted by a competent person where I am under the age of
            18), hereby agree</span> to the processing of my personal information for purposes of applying to TAMA Organizationsa the responsible party with its registered address at
            D995 Sheleni Road Adams Mission Durban 4100 and permit TAMA Organizationsa to process my information for the purpose of sharing/forwarding/applying to universities & Colleges I have selected and course relevant bursaries and NSFAS application on my behalf.</p>
            
            <p>TAMA Organizationsa is committed to protecting the applicant's privacy and recognises that it needs to comply
            with statutory requirements insofar as it is necessary to process the applicant's personal
            information.</p> 
            
            <p>In terms of section 18 of the Protection of Personal Information Act 4 of 2013, TAMA Organizationsa
            is obligated to inform you of the following:</p>
            <ul>
            	
            	<p>1. The type of information that TAMA Organization will collect and process which will include any personal
            information which can identify you, your matriculation marks, national benchmark test scores and first year university marks (if applicable);</p>
            <p>2. The nature/category of the information that TAMA Organizationsa will process will relate to academic
            performance indicators.</p>
            <p>3. The purpose of processing and analysing the information will be to consider advising the applicant about career choice depending on the information submitted and share/forward/apply on behalf of the applicant to all universities selected by applicant including bursaries related to selected career choice and NSFAS.</p>
            <p>4. TAMA Organizationsa will source the information from yourself, the Department of Education and other
            university records (where applicable).</p>
            <p>5. TAMA Organizationsa may, where applicable, transfer the information to a third party country /
            organisation.</p>
            <p>6. Failure to consent to the processing of such information may results in termination of your application request with TAMA Organizationsa.</p>
            <p>7. You have the right to access and to amend any information processed by TAMA Organizationsa at any
            reasonable time.</p>
            8. You have the right to direct any complaint regarding the processing of your information
            to the Information Regulator.
            Further to the above consent, I understand that my personal information is also protected in
            terms of section 50 of the Electronic Communications and Transactions Act 25 of 2002 (ECT Act).
            In terms of section 51 of the ECT Act, I hereby provide my express written permission to TAMA Organizationsa for
            the collection, collation, processing and sharing/forwarding/applying to universities/Colleges of my choice, bursaries and NSFAS institutions.</p>
            	
            </ul>
            
            
            <h2 style="color:blue;">ADMINISTRATION FEE POLICY</h2>
            <p><span style="color:green;">I, the undersigned applicant (duly assisted by a competent person where I am under the age of
            18), hereby understand</span> that the Administration Fee is mandatory to be paid by Applicant. I understand that by paying this Administration fee I am not paying for TAMA Organizationsa Services as they are Non Profit Company Services but paying for the System Administration to perform System/App needs such as updates, upgrades, Security Matters, etc.</p>
            
            <p><span style="color:green;">I, the undersigned applicant (duly assisted by a competent person where I am under the age of
            18), hereby declare</span> that aslong as i have not made the Administration fee payment my application request should not be processed and remain on hold until i have made/processed the payment of Administration Fee. In case I (the applicant) do not make/Process the Administration Fee payment until the closing date of TAMA Organizationsa and the Late application  closing date (if applicable), TAMA has the right to consider terminating my application.</p>
            

		</div>
		<code>to continue accept terms and conditions.</code>
		<div class="optionaln flex">
			
			<div class="flat flex">
			 Do you accept terms of use? <select id="accept"><option value="Yes">Yes</option><option value="No">No</option></select>
			</div>
			
		</div>
		<div id="erroragreement" hidden></div>
		<button class="btn" type="button" id="acceptcondition">Submit</button>
		<div id="acceptconditionerror" hidden></div>
		<?php
	}
	protected function getAmountToPay($applicationid){
		global $conn;
		$_=$conn->query("select schoolname from step5 where applicationid='$applicationid'");
		if($_->num_rows!=1){
			echo "<h2 style='background-color:red;color:#f3f3f3;'>Application ID not Found</h2>";
			return "ERROR 401:";
		}
		else{
			return $this->getAmount(mysqli_fetch_array($_)['schoolname']);
		}

	}
	protected function getAmount($schoolname){
		global $conn;
		$_=$conn->query("select amount from highschools where id='$schoolname'");
		if($_->num_rows!=1){
			echo "<h2 style='background-color:red;color:#f3f3f3;'>School Name not Found</h2>";
			return "ERROR 401:";
		}
		else{
			return mysqli_fetch_array($_)['amount'];
		}

	}
	protected function getStudentId($my_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select applicationid from step1 where std_id='$my_id'"))['applicationid'];
	}
	protected function getSchoolId($applicationid){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select schoolname from step5 where applicationid='$applicationid'"))['schoolname'];
	}
	protected function getEmailUser($my_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select usermail from create_runaccount where my_id='$my_id'"))['usermail'];
	}
	protected function dataToString($dataArray) {
      // Create parameter string
        $pfOutput = '';
        foreach( $dataArray as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        return substr( $pfOutput, 0, -1 );
    }
    protected function generateSignature($data, $passPhrase = null) {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if(!empty($val)) {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5($getString);
    }
    protected function generatePaymentIdentifier($pfParamString, $pfProxy = null) {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://www.payfast.co.za/onsite/process';
    
            // Create default cURL object
            $ch = curl_init();
    
            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
    
            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
    
            // Execute cURL
            $response = curl_exec( $ch );
            curl_close($ch );
            // echo $response;
            $rsp = json_decode($response, true);
            if ($rsp['uuid']) {
                return $rsp['uuid'];
            }
        }
        return null;
    }
    protected function pfValidIP() {
        // Variable initialization
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
            );
    
        $validIps = [];
    
        foreach( $validHosts as $pfHostname ) {
            $ips = gethostbynamel( $pfHostname );
    
            if( $ips !== false )
                $validIps = array_merge( $validIps, $ips );
        }
    
        // Remove duplicates
        $validIps = array_unique( $validIps );
        $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
        if( in_array( $referrerIp, $validIps, true ) ) {
            return true;
        }
        return false;
    }
    protected function pfValidPaymentData( $cartTotal, $pfData ) {
        return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
    }
    protected function pfValidSignature( $pfData, $pfParamString, $pfPassphrase = null ) {
        // Calculate security signature
        if($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
        }
    
        $signature = md5( $tempParamString );
        return ( $pfData['signature'] === $signature );
    }
    protected function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://'. $pfHost .'/eng/query/validate';
    
            // Create default cURL object
            $ch = curl_init();
        
            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
            
            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
        
            // Execute cURL
            $response = curl_exec( $ch );
            curl_close( $ch );
            if ($response === 'VALID') {
                return true;
            }
        }
        return false;
    }
	protected function step9($array){
		global $conn;
		$std_id=$array['my_id'];
	    $amountToPay=$this->getAmountToPay($this->getApplicationId($array['my_id']));
	    $applicant_id=$this->getStudentId($array['my_id']);
	    $school=$this->getSchoolId($applicant_id);
		if($this->isAcceptedTerms($this->getApplicationId($array['my_id']))){
			$amountToPay=$this->getAmountToPay($this->getApplicationId($array['my_id']));
			if(isset($_GET['payment'])){
			    if(isset($_GET['c'])){
			        header( 'HTTP/1.0 200 OK' );
                    flush();
                    // require_once("controller/pdo.php");
                    define( 'SANDBOX_MODE', true );
                    $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
                    // Posted variables from ITN
                    $pfData = $_POST;
                    
                    // Strip any slashes in data
                    foreach( $pfData as $key => $val ) {
                        $pfData[$key] = stripslashes( $val );
                    }
                    
                    // Convert posted variables to a string
                    foreach( $pfData as $key => $val ) {
                        if( $key !== 'signature' ) {
                            $pfParamString .= $key .'='. urlencode( $val ) .'&';
                        } else {
                            break;
                        }
                    }
                    // $myFile= fopen("notify.txt","wb")or die;
                    $pfParamString = substr( $pfParamString, 0, -1 );
                    
                    $check1 = $this->pfValidSignature($pfData, $pfParamString);
                    // $check1 ? fwrite($myFile,"pfData: ".$pfData."\n\nPFPARAM : ".$pfParamString."\n\n is valid signiture"):fwrite($myFile,$pfData."\n\n".$pfParamString."\n\n is NOT valid signiture");
                    $check2 = $this->pfValidIP();
                    if($amountToPay=="R150.00"){
                        $amountToPay='150.00';
                    }
                    elseif($amountToPay=="R250.00"){
                        $amountToPay='250.00';
                    }
                    else{
                        $amountToPay='200.00';
                    }
                    $check3 = $this->pfValidPaymentData($amountToPay, $pfData);
                    $check4 = $this->pfValidServerConfirmation($pfParamString, $pfHost);
                    
                    if($check1 && $check2 && $check3 && $check4) {
                        $std_id=$array['my_id'];
                	    $amountToPay=$this->getAmountToPay($this->getApplicationId($array['my_id']));
                	   // $proof_of_payment=$_GET['pt'];
                	    $applicant_id=$this->getStudentId($array['my_id']);
                	    $school=$this->getSchoolId($applicant_id);
                        $m_payment_id=$pfData['m_payment_id'];
                        $pf_payment_id=$pfData['pf_payment_id'];
                        $payment_status=$pfData['payment_status'];
                        $item_name=$pfData['item_name'];
                        $item_description=$pfData['item_description'];
                        $amount_gross=$pfData['amount_gross'];
                        $amount_fee=$pfData['amount_fee'];
                        $amount_net=$pfData['amount_net'];
                        $name_first=$pfData['name_first'];
                        $name_last=$pfData['name_last'];
                        $email_address=$pfData['email_address'];
                        $merchant_id=$pfData['merchant_id'];
                        if(!$conn->query("insert into payment(applicationid,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded)values('$applicationid','$m_payment_id','$pf_payment_id','$payment_status','$item_name','$item_description','$amount_gross','$amount_fee', '$amount_net', '$name_first', '$name_last', '$email_address', '$merchant_id','$school',NOW())")){
                            echo $conn->error;
                        }
                        else{
                            if($conn->query("update testing set level='9' where my_id='$std_id'")){
            					$emailTo=$this->getEmailUser($array['my_id']);
            				    $emailFrom="np-reply@netchatsa.com";
            				    $Message="<p>Dear Applicant</p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL</h5><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 9th step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
            				    $subject="TAMA APPLICATIONSA (Completion of step9 Alert)";
            				    require_once("../controller/pdo.php");
            				    $pdo=new applications();
            				    $pdo->emailSender($emailTo,$emailFrom,$Message,$subject);
            				    ?>
            				    <script>
            				        window.location=("./?_=apply")
            				    </script>
            				    <?php
            		        }
            		        else{
            		            echo"Report this error: ".$conn->error;
            		        }
                        }
                    } 
                    else {
                        echo"report this error: WhatsApp{068 515 3023}";
                    }
                }
                if(isset($_POST["paynow"])){
                    $std_id=$array['my_id'];
            	    $amountToPay=$this->getAmountToPay($this->getApplicationId($array['my_id']));
            	    $applicant_id=$this->getStudentId($array['my_id']);
            	    $school=$this->getSchoolId($applicant_id);
                    $step1_info=$this->getStep1Info($applicant_id);
            		$step2_info=$this->getStep2Info($applicant_id);
            		$step3_info=$this->getStep3Info($applicant_id);
            		$step4_info=$this->getStep4Info($applicant_id);
            		$step5_info=$this->getStep5Info($applicant_id);
                    if($amountToPay=="R150.00"){
                        $amountToPay="150.00";
                    }
                    elseif($amountToPay=="R200.00"){
                        $amountToPay="200.00";
                    }
                    elseif($amountToPay=="R250.00"){
                        $amountToPay="250.00";
                    }
                    else{
                        $amountToPay="150.00";
                    }
                    $passPhrase = 'msiziMzobe98';
                    $data = array(
                        'merchant_id' => '18152361',
                        'merchant_key' => '2ammma77nrah4',
                        'return_url' => 'https://netchatsa.com/?_=apply',
                        'cancel_url' => 'https://netchatsa.com/?_=apply&b',
                        'notify_url' => 'https://netchatsa.com/?_=apply&c',
                        'name_first'=>$step2_info['fname'],
                        'name_last'=>$step2_info['title']." ".$step2_info['initials']." ".$step2_info['lname'],
                        'email_address'=>$step3_info['email'],
                        'm_payment_id' => $step2_info['idnumber'],
                        'amount' => $amountToPay,
                        'item_name' => 'TAMA ORGANIZATIONSA TERTIARY APPLICATIONS',
                        
                        
                    );
                        // Generate signature (see Custom Integration -> Step 2)
                    $data["signature"] = $this->generateSignature($data, $passPhrase);
                    $pfParamString = $this->dataToString($data);
                    
                    $identifier = $this->generatePaymentIdentifier($pfParamString);
                    if($identifier!==null){
                   ?>
                   <script>
                      window.payfast_do_onsite_payment({"uuid":"<?php echo $identifier;?>"});
                    </script>
                       <?php
                   }
                
                }
            
			}
			?>
			<style>
				.infopack,.payCash,.payCard{
					width: 100%;
					box-shadow: 0 8px 6px -6px black;
					padding: 10px 0;
				}
				.payCash .btn,.payCard .btn{
					color: #f3f3f3;
					background-color: navy;
					width: 80%;
					padding: 6px 0;
					border: 1px solid yellowgreen;
				}
				.payCash .btn:hover,.payCard .btn:hover{
					background-color: seagreen;
				}
			</style>
			<div class="infopack">
				<h2 >To Process Your Applications Please Pay <?php echo $amountToPay;?> Admin Fee.</h2>
			</div>
			<hr>
			<div class="payCash">
				<button class="btn" id="paycash">CASH PAYMENT</button>
			</div>
			<hr>
			<div class="payCard">
				<button class="btn" id="paycard">ELECTRONICAL PAYMENT</button>
			</div>
			<hr>
			
			<div class="payCard_online" disabled hidden>
				<form action="?_=apply&payment" method="post">
                   <input type="submit" name="paynow" value="PAY-NOW R<?php echo $amountToPay;?>">
                </form>
			</div>
			<div class="PayCash_details" disabled hidden>
				<h2>BANK ACCOUNT DETAILS </h2>
				<div class="macO" style="display:flex;">
				    <style>
				        .mod{
				            width:40%;
				            text-align:left;
				        }
				    </style>
					<div class="mod">
					   <ul>
					    <li>Bank Name </li>
    					<li>Account Holder</li>
    					<li>Account no </li>
    					<li>Branch code </li>
    					<li>Reference ID</li>
    				  </ul>
					</div>
					<div class="mod">
					  <ul>
					    <li>: CAPITEC</li>
    					<li>: TAMA</li>
    					<li>: 17 88 90 74 08</li>
    					<li>: 47 00 10</li>
    					<li>: Your ID Number</li>
    				  </ul>
					</div>
					
					
				</div>
				<div class="uload">
					<h5>Upload Proof Of Payment Here</h5>
					<input disabled type="file" name="file" id="proofofpayment" placeholder="Proof Of Payment">
				</div>
				<!--send ProofOfPayment to: (WhatsApp): 068 515 3023 or <br>(mzobems@tamaorganizationsa.org or<br>tamaorg18@gmail.com)-->
				<div id="proofofpaymenterror" hidden></div>
			</div>
			<?php
		}
		else{
			echo "no";
		}
	}
	protected function isAcceptedTerms($applicationid){
		global $conn;
		$_=$conn->query("select accept from terms_conditions where applicationid='$applicationid'");
		if($_->num_rows!=1){
			echo "<h2 style='background-color:red;color:#f3f3f3;'>Application ID not Found</h2>";
			return false;
		}
		else{
			if(mysqli_fetch_array($_)["accept"]=="Yes"){
				return true;
			}
			else{
				return false;
			}
		}
	}
    protected function getStep1Info($applicant_id){
        global $conn;
        return mysqli_fetch_array($conn->query("select * from step1 where applicationid='$applicant_id'"));
    }
    protected function getStep2Info($applicant_id){
        global $conn;
        return mysqli_fetch_array($conn->query("select * from step2 where applicationid='$applicant_id'"));
    }
    protected function getStep3Info($applicant_id){
        global $conn;
        return mysqli_fetch_array($conn->query("select * from step3 where applicationid='$applicant_id'"));
    }
    protected function getStep4Info($applicant_id){
        global $conn;
        return mysqli_fetch_array($conn->query("select * from step4 where applicationid='$applicant_id'"));
    }
    protected function getStep5Info($applicant_id){
        global $conn;
        return mysqli_fetch_array($conn->query("select * from step5 where applicationid='$applicant_id'"));
    }
    protected function getInstitutionName($uni_id){
        global $conn;
        return mysqli_fetch_array($conn->query("select uni_name from universities where id='$uni_id'"))['uni_name'];
    }
	protected function step10($array){
		global $conn;
		$paymentStatusDisplay="";
		$applicant_id=$this->getApplicationId($array['my_id']);
		$paymentStatus=$this->getPaymentStatus($applicant_id);
		if($paymentStatus){
		    if($paymentStatus=="PENDING"){
		        $paymentStatusDisplay="<h5 style='color:red;'><span style='color:#f3f3f3;'>PAYMENT: </span>".$paymentStatus."</h5>";
		    }
		    else{
		        $paymentStatusDisplay="<h5 style='color:green;'><span style='color:#f3f3f3;'>PAYMENT: </span>".$paymentStatus."</h5>";
		    }
			
		
    		$step1_info=$this->getStep1Info($applicant_id);
    		$step2_info=$this->getStep2Info($applicant_id);
    		$step3_info=$this->getStep3Info($applicant_id);
    		$step4_info=$this->getStep4Info($applicant_id);
    		$step5_info=$this->getStep5Info($applicant_id);
    		
    		?>
    		<style>
    		    .mob-flex{
    		        display:flex;
    		    }
    		    .displayApplication{
    		        width:100%;
    		    }
    		    .displayApplication .1stDetails{
    		        width:100%;
    		        background-color:red;
    		    }
    		    .btn-mob{
    		        color:#f3f3f3;
    		        background-color:#e8491d;
    		        border:2px solid #f3f3f3;
    		    }
    		</style>
    		<div class="displayApplication">
    		    <div class="1stDetails" style="border-bottom:2px solid #e8491d;">
    		        <div class="mac_id" style="text-align:left;">
    		            Application ID : <?php echo $step2_info['applicationid'];?>
    		        </div>
    		        <div class="mac_id" style="text-align:left;">
    		            Student Name : <?php echo $step2_info['title']." ".$step2_info['initials']." ".$step2_info['lname'];?>
    		        </div>
    		        <div style="text-align:left;" ><?php echo $paymentStatusDisplay;?></div>
    		    </div>
    		    <br>
    		    <div class="row" style="width:100%;">
                  <div class="col-md-12 mb-3">
                    <div class="card">
                      <div class="card-header" style="background-color:#212121;border-bottom:1px solid #f2f2f2;">
                        <span><i class="bi bi-table me-2"></i></span>Application Table
                      </div>
                      <div class="card-body" style="background-color:#212121;">
                        <div class="table-responsive" style="background-color:#212121;border:1px solid #f2f2f2;">
                          <table
                            id="example"
                            class="table table-striped data-table"
                            style="width: 100%;background-color:#212121;color:#f3f3f3;"
                          >
                            <thead>
                              <tr>
                                <th>Institution</th>
                                <th>course</th>
                               
                                <th>Status</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                <style>
                                            .ramButtonModalView{
                                                background-color:red;color:#f3f3f3;padding:2px;
                                            }
                                            .ramButtonModalView:hover{
                                                background-color:crimson;
                                                border:#f3f3f3;
                                                color:#f3f3f3;
                                            }
                                        </style>
                              <?php 
                              $_px=$conn->query("select*from finalapplication where applicationid='$applicant_id'");
                              
                              while($row=mysqli_fetch_array($_px)){
                                  $institution =$this->getInstitutionName($row['uni_id']);
                                  $course =$this->geCourse($row['course_id']);
                                  ?>
                                  <tr>
                                    <td><?php echo $institution;?></td>
                                    <td><?php echo $course;?></td>
                                   
                                    <td><button class="btn ramButtonModalView">view</button></td>
                               
                                  </tr>
                                 <?php
                              }
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>Institution</th>
                                <th>Course</th>
                                
                                <th>Status</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <?php
                if(isset($_POST['addButn'])&&isset($_POST['uni'])){
                    $uni=$_POST['uni'];
                    ?>
                <div>
                    <div class="too-do-match">
                        <form action="./?_=apply" method="post">
                            <input type="hidden" name="tmp" value="<?php echo $uni;?>">
                            <select class="rosseBruse" name="brues" required>
                                
                                <option value="">-- Select Faculty --</option>
                                <?php
                                $_code_match=$conn->query("select*from faculties where uni_id='$uni'");
                                while($row=mysqli_fetch_array($_code_match)){
                                    ?>
                                    <option value="<?php echo $row['faculty_id'];?>"><?php echo $row['faculty_name'];?></option>
                                    <?php
                                }
                                ?>
                                
                            </select>
                            <br><br>
                            <button class="btn" name="addBtnb" style="border:1px solid #f3f3f3;color:#f3f3f3;">Add Faculty</button>
                        </form>
                    </div>        
                </div>
                    <?php
                }
                elseif(isset($_POST['addBtnb'])&&isset($_POST['brues']) && isset($_POST['tmp'])){
                    $faculty=$_POST['brues'];
                    $uni=$_POST['tmp']; 
                    ?>
                    <input type="hidden" name="faculty" class="a" value="<?php echo $_POST['brues'];?>">
                    <input type="hidden" name="uni" class="b" value="<?php echo $_POST['tmp'];?>">
                    <select class="c" name="brues" required>
                        
                        <option value="">-- Select Course --</option>
                        <?php
                        $_code_match=$conn->query("select*from courses where uni_id='$uni' and faculty_id='$faculty'");
                        while($row=mysqli_fetch_array($_code_match)){
                            ?>
                            <option value="<?php echo $row['course_id'];?>"><?php echo $row['course_name'];?></option>
                            <?php
                        }
                        ?>
                        
                    </select>
                    <br><br>
                    <button class="btn bedant" name="addBtnb" style="border:1px solid #f3f3f3;color:#f3f3f3;">Add Course</button>
                    <script>
                        $(document).ready(function(){
                            $(".bedant").click(function(){
                                const a=$(".a").val();
                                const b=$(".b").val();
                                const c=$(".c").val();
                                console.log(a+" "+b+" "+c);
                                if(c!=""){
                                    $(".bedant").removeAttr('hidden');
                                    $(".bedant").html("<img style='width:4%;color:#f3f3f3;' src='../../default-img/loader.gif'> Adding Course...");
                                    $.ajax({
                            		url:'controler/upload.php',
                            		type:'post',
                            		data:{a:a,b:b,c:c},
                            		success:function(e){
                            		    if(e.length<=2){
                            		        $(".bedant").attr("style","background-color:green;color:#fff;");
                            		        $(".bedant").html("Course Added Successfuly...");
                            		        window.location=("https://netchatsa.com/view/?_=apply");
                            		    }
                            		    else{
                            		        $(".bedant").attr("style","background-color:black;color:red;");
                            		        $(".bedant").html(e);
                            		    }
                            			
                            		}
                	});
                                }
                                
                            });
                        });
                    </script>
                    <?php
                }
                else{
                    ?>
                <div class="add-uni-application">
                    <button class="btn btn-mob" data-toggle="modal" data-target="#addApplicationTertiary">Add Application</button>
                </div>
                    <?php
                }
                ?>
                
                
                <br>
                <p style="color:red;border:1px solid red;font-size:11.5px;">NOTE that NSFAS & Relavant Bursary Applications will be displayed here once application process has been started with SOON to open Bursary offering Institutions.</p>
                
    		    
    		</div>
		<?php
		}
		else{
		    echo "YOU HAVE NOT MADE PAYMENT!!";	
		}
	}
	protected function geCourse($couse_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select course_name from courses where course_id='$couse_id'"))['course_name'];
	}
	protected function getPaymentStatus($applicationid){
		global $conn;
		$_="select applicationid from payment where applicationid=? Limit 1";
		$stmt = $conn->prepare($_);
		$stmt->bind_param("s", $applicationid);
		$stmt->execute();
		$stmt->bind_result($applicationid);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum==1){
		    $_1=mysqli_fetch_array($conn->query("select*from payment where applicationid='$applicationid'"));
		    return $_1['payment_status'];
		}
		else{
		    return false;
		}
	}
	protected function step11($array){
		global $conn;
		echo "display step 11 form";
	}
	protected function step12($array){
		global $conn;
		echo "display step 12 form";
	}
	protected function step13($array){
		global $conn;
		echo "display step 13 form";
	}
	protected function step14($array){
		global $conn;
		echo "display step 14 form";
	}
	protected function step15($array){
		global $conn;
		echo "display step 15 form";
	}
	protected function step16($array){
		global $conn;
		echo "display step 16 form";
	}
	protected function step17($array){
		global $conn;
		echo "display step 17 form";
	}
	protected function getAllSchools(){
		global $conn;
		$_=$conn->query("select*from highschools");
		while($row=mysqli_fetch_array($_)){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['school'];?></option>
			<?php
		}
	}
	protected function yearCompleted(){
		global $conn;
		$_=$conn->query("select*from yearcompleted");
		while($row=mysqli_fetch_array($_)){
			?>
			<option value="<?php echo $row['yearc'];?>"><?php echo $row['yearc'];?></option>
			<?php
		}

	}
	protected function isUploaded1($array){
		global $conn;
		$applicationId=$this->getApplicationId($array['my_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$_=mysqli_fetch_array($conn->query("select idcopy from step5 where applicationid='$applicationId'"))['idcopy'];
			if($_=="empty"){
				return false;
			}
			else{
				return true;
			}

		}
	}
	protected function isUploaded2($array){
		global $conn;
		$applicationId=$this->getApplicationId($array['my_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$_=mysqli_fetch_array($conn->query("select finalresults from step5 where applicationid='$applicationId'"))['finalresults'];
			if($_=="empty"){
				return false;
			}
			else{
				return true;
			}

		}
	}
	protected function isUploaded3($array){
		global $conn;
		$applicationId=$this->getApplicationId($array['my_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$_=mysqli_fetch_array($conn->query("select proofresident from step5 where applicationid='$applicationId'"))['proofresident'];
			if($_=="empty"){
				return false;
			}
			else{
				return true;
			}

		}
	}
	protected function isUploaded4($array){
		global $conn;
		$applicationId=$this->getApplicationId($array['my_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$_=mysqli_fetch_array($conn->query("select guardianid from step5 where applicationid='$applicationId'"))['guardianid'];
			if($_=="empty"){
				return false;
			}
			else{
				return true;
			}

		}
	}
	protected function getApplicationId($my_id){
		global $conn;
		$_=$conn->query("select applicationid from step1 where std_id='$my_id'");
		if($_->num_rows!=1){
			return "absent";
		}
		else{
			return mysqli_fetch_array($_)['applicationid'];
		}
	}

}
?>