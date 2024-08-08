<?php
namespace Src\Classes\Drama;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Factory\MMSServiceONLYFactory;
use App\Providers\Constants\ServiceConstants;
use Src\Classes\PayFast\PayFastIntegration;
use App\Providers\MMSHightech\MMSHightech;
use App\Providers\Response\Response;

class DramaClassPdo{
	// use DBConnectServiceTrait;
	private $matricUpgrade;
	private $TertiaryApplications;
	private $payFastIntegration;
	private $connect;
    private $Response;
    public function __construct(MMSHightech|null $makeConnection=null)
    {
        if(!isset($makeConnection)){
            $makeConnection = MMSServiceONLYFactory::make(ServiceConstants::MMSHIGHTECH,[StatusConstants::CONNECTION_STATUS_NOT_CONNECTED]);
        }
        $this->connect =$makeConnection;
        $this->Response = new Response();
        $this->TertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$this->connect]);
		$this->matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$this->connect]);
		$this->payFastIntegration=new PayFastIntegration();
    }
	public function step2($array){
		?>
			<div class="step2">
				<div class="headerWarner">
					<h2>Personal Details(Step:2)</h2>
				</div>
				<div class="personalDetails">
					<div class="info flex">
						<div class="div"><h6>South African?</h6></div>
						<div class="div2">
							<select id="sa" >
								<option value="">-- --</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="foreign flex" hidden>
						<div class="text">Passport Number : </div>
						<div class="input_mac">
							<input type="text" id="passport" placeholder="Enter Passport Number" required="">
						</div>
					</div>
					<div class="southafrican flex" hidden> 
						<div class="text">SA ID Number : </div>
						<div class="input_mac">
							<input type="number" maxlength="13" minlength="13" id="idNumber" placeholder="Enter SA ID Number" required="">
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
							<div class="right">
							    <label class="label">Gender</label>
							    <select id="gender" required><option value=""> -- Please Select -- </option><option value="male">Male</option><option value="Female">Female</option></select></div>
						</div>
						<div id="errorgender" hidden></div>
						<div class="myPerso flex">
							<div class="left">Date Of Birth</div>
							<div class="right">
							    <label class="label">date of birth</label>
							    <input type="date" id="dob" required="" placeholder="date of birth"></div>
						</div>
						<div id="errordob" hidden></div>
						<div class="myPerso flex">
							<div class="left">title</div>
							<div class="right">
							    <label class="label">title</label>
							    <select id="title" required=""><option value=""> -- Please select -- </option><option value="Mr"> Mr</option><option value="Mrs"> Mrs</option><option value="Dr"> Dr</option><option value="Ms"> Ms</option><option value="Prof"> Prof</option><option value="Miss"> Miss</option></select></div>
						</div>
						<div id="errortitle" hidden></div>
						<div class="myPerso flex">
							<div class="left">initials</div>
							<div class="right">
							    <label class="label">initials</label>
							    <input type="text" id="initials" required="" placeholder="Enter Initials"></div>
						</div>
						<div id="errorinitials" hidden></div>
						<div class="myPerso flex">
							<div class="left">Surname</div>
							<div class="right">
							    <label class="label">Surname</label>
							    <input type="text" id="lname" required="" placeholder="Enter Surname"></div>
						</div>
						<div id="errorlname" hidden></div>
						<div class="myPerso flex">
							<div class="left">First Name</div>
							<div class="right">
							    <label class="label">First Name</label>
							    <input type="text" id="fname" required="" placeholder="Enter First Name"></div>
						</div>
						<div id="errorfname" hidden></div>
						<div class="myPerso flex">
							<div class="left">Marital Status</div>
							<div class="right">
							    <label class="label">Marital Status</label>
							    <select id="status" required><option value=""> -- Please Select -- </option><option value="married">Married</option><option value="divorced">Divorced</option><option value="divorced">Single</option></select></div>
						</div>
						<div id="errorstatus" hidden></div>
						<div class="myPerso flex">
							<div class="left">Home Language</div>
							<div class="right">
							    <label class="label">Home Language</label>
							    <select id="hlang" required><option value=""> -- Please Select--</option><?php $this->TertiaryApplications->getAllLanguages();?></select></div>
						</div>
						<div id="errorhlang" hidden></div>
						<div class="myPerso flex">
							<div class="left">Ethnic Group</div>
							<div class="right">
							    <label class="label">Ethnic Group</label>
							    <select id="EthnicGroup" required><option value=""> -- Please Select</option><option value="black">Black</option><option value="white">White</option><option value="coloured">Coloured</option><option value="other">Other</option></select></div>
						</div>
						<div id="errorEthnicGroup" hidden></div>
						<div class="myPerso flex">
							<div class="left">Are You Employed?</div>
							<div class="right">
							    <label class="label">Are You Employed?</label>
							    <select id="Employed" required><option value=""> -- Please Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>
						</div>
						<div id="errorEmployed" hidden></div>
						<div class="myPerso flex">
							<div class="left">Where did you hear about us?</div>
							<div class="right">
							    <label class="label">Where did you hear about us?</label>
							    <select id="hear" required><option value="netchatsa"> Netchatsa</option></select></div>
						</div>
						<div id="errorhear" hidden></div>
						<div class="myPerso flex">
							<div class="left">Is Bursary Required</div>
							<div class="right">
							    <label class="label">Is Bursary Required</label>
							    <select id="bursary" required><option value=""> -- Please Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>
						</div>
						<div id="errorbursary" hidden></div>
						
					</div>
				</div>
				<hr>
				<!-- <button id="do">dlknjn</button> -->
				<div class="personalDetails">
					<div class="info1">
						<button id="_1_" type="submit" class="btn submitStep2" onclick="submitStep2('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
					</div>


				</div>
				<div class="errorCatch2" hidden></div>
			</div>
			<script>
				$(document).ready(function(){
					$(".foreign").attr("hidden","true");
					$(".southafrican").attr("hidden","true");
					$('#sa').on('change', function() {
					  const sa=$("#sa").val();
					  if(sa=="Yes"){
					  	$(".southafrican").removeAttr("hidden");
					  	$(".foreign").attr("hidden","true");
					  }
					  else if(sa=="No"){
					  	$(".foreign").removeAttr("hidden");
					  	$(".southafrican").attr("hidden","true");
					  }
					  else{
					  	$(".foreign").attr("hidden","true");
						$(".southafrican").attr("hidden","true");
					  }
					});
				});
				
			</script>
		<?php
	}
	
	public function step3($array){
		?>
		<div class="step2"><!--step 3-->
			<div class="headerWarner">
				<h2>Residental Information(Step:3/17)</h2>
			</div>
			<hr>
			
			<div class="personalDetails">
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Street Name</div>
						<div class="right">
						    <label class="label">Street Name</label>
						    <input type="address" id="street" placeholder="Enter Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">Suburb Name</div>
						<div class="right">
						    <label class="label">Suburb Name</label>
						    <input type="address" id="suburb" required="" placeholder="Enter Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">Town Name</div>
						<div class="right">
						    <label class="label">Town Name</label>
						    <input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">Province Name</div>
						<div class="right">
						    <label class="label">Province Name</label>
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
						<div class="right">
						    <label class="label">Postal Code</label>
						    <select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->TertiaryApplications->getAllPostalCodes();?></select></div>
						
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
						<div class="right">
						    <label class="label">Phone Number</label>
						    <input type="number" id="phone" placeholder="Enter Cell Phone Number"></div>
					</div>
					<div id="errorphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Telephone</div>
						<div class="right">
						    <label class="label">Telephone</label>
						    <input type="number" id="telephone" placeholder="Enter Telephone Number"></div>
					</div>
					<div id="errortelephone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Email Address</div>
						<div class="right">
						    <label class="label">Email Address</label>
						    <input type="email" id="email" placeholder="Enter Email Address"></div>
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
						<div class="right flex">
						    <label class="label">Do you want to apply for Resident?</label>
						    <select id="res" required=""><option value="">-- Do you want to apply for Resident? -- </option><option value="yes">Yes</option><option value="no">No</option></select></div>
					</div>
					<div id="errorres" hidden></div>
					<div class="myPerso flex">
						<div class="left">Do you have Disabilities/impairment?</div>
						<div class="right flex">
						    <label class="label">Do you have Disabilities/impairment?</label>
						    <select id="dis" required=""><option value="">-- Do you have Disabilities/impairment? -- </option><option value="yes">Yes</option><option value="no">No</option></select></div>
					</div>
					<div id="errordis" hidden></div>
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<div class="info1">
					<button id="_3_" type="submit" class="btn" onclick="submitStep3('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
				</div>
			</div>
			<div class="errorCatch3" hidden></div>
		</div>
		<script>
// 			function submitStep3(studedentApplicationId,my_id_step3){
// 				// $("#_3_").attr("disabled","true");
// 				const street=$("#street").val();
// 				const suburb=$("#suburb").val();
// 				const town=$("#town").val();
// 				const province=$("#province").val();
// 				const postal=$("#postal").val();
// 				const phone=$("#phone").val();
// 				const telephone=$("#telephone").val();
// 				const email=$("#email").val();
// 				const res=$("#res").val();
// 				const dis=$("#dis").val();
// 				console.log(street+" "+suburb+" "+town+" "+province+" "+postal+" "+phone+" "+telephone+" "+email+" "+res+" "+dis);
// 				$("#errorstreet").attr("hidden","true");
// 				$("#errorsuburb").attr("hidden","true");
// 				$("#errortown").attr("hidden","true");
// 				$("#errorprovince").attr("hidden","true");
// 				$("#errorpostal").attr("hidden","true");
// 				$("#errorphone").attr("hidden","true");
// 				$("#errortelephone").attr("hidden","true");
// 				$("#errortelephone").attr("hidden","true");
// 				$("#errorres").attr("hidden","true");
// 				$("#errordis").attr("hidden","true");
// 				$(".errorCatch3").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
// 				if(street==""){
// 					$("#errorstreet").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(suburb==""){
// 					$("#errorsuburb").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(town==""){
// 					$("#errortown").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(province==""){
// 					$("#errorprovince").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(postal==""){
// 					$("#errorpostal").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(phone==""){
// 					$("#errorphone").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(telephone==""){
// 					$("#errortelephone").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(email==""){
// 					$("#errortelephone").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(res==""){
// 					$("#errorres").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(dis==""){
// 					$("#errordis").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else{
// 					$.ajax({
// 		                url:'./controller/ajaxCallProcessor.php',
// 		                type:'post',
// 		                data:{
// 							street:street,
// 							suburb:suburb,
// 							town:town,
// 							province:province,
// 							postal:postal,
// 							phone:phone,
// 							telephone:telephone,
// 							email:email,
// 							res:res,
// 							dis:dis,
// 							studedentApplicationId:studedentApplicationId,
// 							my_id_step3:my_id_step3
// 		                },
// 		                success:function(e){
// 		                	console.log(e);
// 		                    if(e.length>1){
// 		                    	$("#_3_").removeAttr("disabled");
// 		                        $(".errorCatch3").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
// 		                    }
// 		                    else{
// 		                         $(".errorCatch3").html("Data Submitted Successfully please wait, redirecting...");
// 		                         loader("apply");
// 		                    }
		                    
// 		                }
// 		            });
// 				}
// 			}
		</script>
		<?php
		
	}
	public function step4($array){
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
						<div class="right">
						    <label class="label">Guardian First Name`s</label>
						    <input type="text" id="fname" placeholder="Enter Guardian First Name"></div>
					</div>
					<div id="errorfname" hidden></div>
					<div class="myPerso flex">
						<div class="left">Guardian Last Name</div>
						<div class="right">
						    <label class="label">Guardian Last Name</label>
						    <input type="text" id="lname" required="" placeholder="Enter Guardian Last Name"></div>
					</div>
					<div id="errorlname" hidden></div>
					<div class="myPerso flex">
						<div class="left">Relationship</div>
						<div class="right">
						    <label class="label">Relationship</label>
						    <select id="relationship" required=""><option value="">-- Select Option --</option><option value="Mother">Mother</option><option value="Father">Father</option><option value="Aunty">Aunty</option><option value="Uncle">Uncle</option><option value="Gogo">Gogo</option><option value="Mkhulu">Mkhulu</option></select></div>
					</div>
					<div id="errorrelationship" hidden></div>
					<div class="myPerso flex">
						<div class="left">Guardian is Employed?</div>
						<div class="right">
						    <label class="label">Guardian is Employed?</label>
						    <select id="employed" required=""><option value="">-- Select Option --</option><option value="Yes">Yes</option><option value="No">No</option></select></div>
					</div>
					<div id="erroremployed" hidden></div>	
					<div class="myPerso flex">
						<div class="left">Phone Number</div>
						<div class="right">
						    <label class="label">Phone Number</label>
						    <input type="number" id="phone" required="" placeholder="Enter Phone Number" maxlength="10" minlength="10"></div>
					</div>
					<div id="errorphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Altenative Phone Number</div>
						<div class="right">
						    <label class="label">Altenative Phone Number</label>
						    <input type="number" id="alphone" required="" placeholder="Enter Altenative Phone Number" maxlength="10" minlength="10"></div>
					</div>
					<div id="erroralphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Email Address</div>
						<div class="right">
						    <label class="label">Email Address</label>
						    <input type="email" id="email" required="" placeholder="Enter email address" ></div>
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
						<div class="right">
						    <label class="label">Street Name</label>
						    <input type="address" id="street" placeholder="Enter Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">Suburb Name</div>
						<div class="right">
						    <label class="label">Suburb Name</label>
						    <input type="address" id="suburb" required="" placeholder="Enter Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">Town Name</div>
						<div class="right">
						    <label class="label">Town Name</label>
						    <input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">Province Name</div>
						
						<div class="right">
						    <label class="label">Province Name</label>
						    
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
						<div class="right">
						    <label class="label">Postal Code</label>
						    <select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->TertiaryApplications->getAllPostalCodes();?></select></div>
						
					</div>
					<h6 style='color:red;'>Can't find your Postal? Send us your proof of resident via WhatsApp(068 515 3023) so we can fix Error.</h6>
					<div id="errorpostal" hidden></div>	
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<div class="info1">
					<button id="_4_" type="submit" class="btn" onclick="submitStep4('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submitd</button>
				</div>
			</div>
			<div class="errorCatch4" hidden></div>
		</div>
		<script>
// 			function submitStep4(applicationidStep4,my_id_step4){
// 				const fname=$("#fname").val();
// 				const lname=$("#lname").val();
// 				const relationship=$("#relationship").val();
// 				const employed=$("#employed").val();
// 				const phone=$("#phone").val();
// 				const alphone=$("#alphone").val();
// 				const email=$("#email").val();
// 				const street=$("#street").val();
// 				const suburb=$("#suburb").val();
// 				const town=$("#town").val();
// 				const province=$("#province").val();
// 				const postal=$("#postal").val();
// 				// $("#_4_").attr("disabled","true");
// 				$(".errorCatch4").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
// 				if(fname==""){
// 					$("#errorfname").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(lname==""){
// 					$("#errorlname").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(relationship==""){
// 					$("#errorrelationship").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(employed==""){
// 					$("#erroremployed").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(phone==""){
// 					$("#errorphone").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(alphone==""){
// 					$("#erroralphone").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(email==""){
// 					$("#erroremail").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(street==""){
// 					$("#errorstreet").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(suburb==""){
// 					$("#errorsuburb").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(town==""){
// 					$("#errortown").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(province==""){
// 					$("#errorprovince").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(postal==""){
// 					$("#errorpostal").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else{
// 					console.log(fname+" "+lname+" "+relationship+" "+employed+" "+phone+" "+alphone+" "+email+" "+street+" "+suburb+" "+town+" "+province+" "+postal+" "+applicationidStep4+" "+my_id_step4);
// 					$.ajax({
// 		                url:'./controller/ajaxCallProcessor.php',
// 		                type:'post',
// 		                data:{

// 							fname:fname,
// 							lname:lname,
// 							relationship:relationship,
// 							employed:employed,
// 							phone:phone,
// 							alphone:alphone,
// 							email:email,
// 							street:street,
// 							suburb:suburb,
// 							town:town,
// 							province:province,
// 							postal:postal,
// 							applicationidStep4:applicationidStep4,
// 							my_id_step4:my_id_step4
// 		                },
// 		                success:function(e){
// 		                	console.log(e);
// 		                    if(e.length>1){
// 		                    	$("#_4_").removeAttr("disabled");
// 		                        $(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
// 		                    }
// 		                    else{
// 		                         $(".errorCatch4").html("Data Submitted Successfully please wait, redirecting...");
// 		                         loader("apply");
// 		                    }
		                    
// 		                }
// 		            });
// 				}
// 			}
			
		</script>
		<?php
	}
	public function step5($array){
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
						    <label class="label">Phone Number</label>
							<select id="schoolname" required><option value=""> -- Select School -- </option><?php $this->TertiaryApplications->getAllSchools();?></select>
						</div>
					</div>
					<div id="errorschoolname" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Street Name</div>
						<div class="right">
						    <label class="label">School Street Name</label>
						    <input type="address" id="street" placeholder="School Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Suburb Name</div>
						<div class="right">
						    <label class="label">School Suburb Name</label>
						    <input type="address" id="suburb" required="" placeholder="Enter School Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Town Name</div>
						<div class="right">
						    <label class="label">School Town Name</label>
						    <input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Province Name</div>
						<div class="right">
						    <label class="label">School Province Name</label>
						    
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
						<div class="right">
						    <label class="label">School Postal Code</label>
						    <select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->TertiaryApplications->getAllPostalCodes();?></select></div>
						
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
						<div class="right">
						    <label class="label">Completion Year</label>
						    <select id="yearcompleted" required=""><option value="">-- Select Completion Year -- </option><?php $this->TertiaryApplications->yearCompleted();?></select></div>
					</div>
					<div id="erroryearcompleted" hidden></div>
					<div class="myPerso flex">
						<div class="left">Current Activity</div>
						<div class="right">
						    <label class="label">Current Activity</label>
						    <select id="activity" required=""><option value="">-- Select Current Activity --</option><option value="Mother">Mother</option><option value="Studying">Studying</option><option value="Working">Working</option><option value="Gap Year">Gap Year</option><option value="Attending Court Case">Attending Court Case</option><option value="College">College</option><option value="Universiy">Universiy</option></select></div>
					</div>
					<div id="erroractivity" hidden></div>
					<div class="myPerso flex">
						<div class="left">Any Tertiary Education History?</div>
						<div class="right">
						    <label class="label">Any Tertiary Education History?</label>
						    <select id="eduhistory" required=""><option value="">-- Any Tertiary Education History? --</option><option value="Yes">Yes</option><option value="No">No</option></select></div>
					</div>
					<div id="erroreduhistory" hidden></div>
					<!-- < -->
					<div class="myPerso flex" id="ExtraEdit" hidden>
						<div class="left">University</div>
						<div class="right">
						    <label class="label">University</label>
						    <input type="text" id="uni" placeholder="Enter University Studied At"></div>
					</div>
					<div id="erroruni" hidden></div>
					<div class="myPerso flex"  id="ExtraEdit1" hidden>
						<div class="left">Student Number</div>
						<div class="right">
						    <label class="label">Student Number</label>
						    <input type="number" id="studentnumber" placeholder="Enter Student Number"></div>
					</div>
					<div id="errorstudentnumber" hidden></div>
					<div class="myPerso flex"  id="ExtraEdit2" hidden>
						<div class="left">Completion Status</div>
						<div class="right">
						    <label class="label">Completion Status</label>
						    <select id="statuscompletion" required=""><option value="">-- Select Completion Status --</option><option value="Completed">Completed</option><option value="Studied: Final Year">Studied: Final Year</option><option value="Studied: Second Year">Studied: Second Year</option><option value="Studied: First Year">Studied: First Year</option><option value="Dropped Out">Dropped Out</option><option value="Expelled/Dismissed">Expelled/Dismissed</option><option value="Financial Excluded">Financial Excluded</option></select></div>
					</div>
					<div id="errorstatuscompletion" hidden></div>	
					<!-- < -->
				</div>
			</div>
			<hr>
			<!--  -->
			<div class="personalDetails">
				<div class="info1">
					<button id="_5_" type="submit" class="btn" onclick="submitStep5('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
				</div>
			</div>
			<div class="errorCatch5" hidden></div>
		</div>
		<script>
			$(document).ready(function(){
				$("#eduhistory").on("change",function(){
					const d=$("#eduhistory").val();
					if(d=="Yes"){
						$("#ExtraEdit").removeAttr("hidden");
						$("#ExtraEdit1").removeAttr("hidden");
						$("#ExtraEdit2").removeAttr("hidden");
					}
					else{
						$("#ExtraEdit").attr("hidden","true");
						$("#ExtraEdit1").attr("hidden","true");
						$("#ExtraEdit2").attr("hidden","true");
						$("#ExtraEdit").val("");
						$("#ExtraEdit1").val("");
						$("#ExtraEdit2").val("");
					}
				});
			});
// 			function submitStep5(applicationidStep5,my_id_step5){
// 				// $("#_5_").attr("disabled","true");
// 				$(".errorCatch5").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
// 				const schoolname=$("#schoolname").val();
// 				const street=$("#street").val();
// 				const suburb=$("#suburb").val();
// 				const town=$("#town").val();
// 				const province=$("#province").val();
// 				const postal=$("#postal").val();
// 				const yearcompleted=$("#yearcompleted").val();
// 				const activity=$("#activity").val();
// 				const eduhistory=$("#eduhistory").val();
// 				const uni=$("#uni").val();
// 				const studentnumber=$("#studentnumber").val();
// 				const statuscompletion=$("#statuscompletion").val();
// 				if(schoolname==""){
// 					$("#errorschoolname").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(street==""){
// 					$("#errorstreet").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(suburb==""){
// 					$("#errorsuburb").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(town==""){
// 					$("#errortown").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(province==""){
// 					$("#errorprovince").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(postal==""){
// 					$("#errorpostal").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(yearcompleted==""){
// 					$("#erroryearcompleted").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(activity==""){
// 					$("#erroractivity").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(eduhistory==""){
// 					$("#erroreduhistory").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}

// 				else{
// 					var bool=true;
// 					if(eduhistory=="Yes"){
// 						if(uni==""){
// 							$("#erroruni").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 							bool=false;
// 						}
// 						else if(studentnumber==""){
// 							$("#errorstudentnumber").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 							bool=false;
// 						}
// 						else if(statuscompletion==""){
// 							$("#errorstatuscompletion").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 							bool=false;
// 						}
// 						else{
// 							bool=true;
// 						}
// 					}
// 					if(bool){
// 						$.ajax({
// 			                url:'./controller/ajaxCallProcessor.php',
// 			                type:'post',
// 			                data:{
// 								applicationidStep5:applicationidStep5,
// 								my_id_step5:my_id_step5,
// 								schoolname:schoolname,
// 								street:street,
// 								suburb:suburb,
// 								town:town,
// 								province:province,
// 								postal:postal,
// 								yearcompleted:yearcompleted,
// 								activity:activity,
// 								eduhistory:eduhistory,
// 								uni:uni,
// 								studentnumber:studentnumber,
// 								statuscompletion:statuscompletion
// 			                },
// 			                success:function(e){
// 			                	console.log(e);
// 			                    if(e.length>1){
// 			                    	$("#_4_").removeAttr("disabled");
// 			                        $(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
// 			                    }
// 			                    else{
// 			                         $(".errorCatch5").html("Data Submitted Successfully please wait, redirecting...");
// 			                         loader("apply");
// 			                    }
			                    
// 			                }
// 			            });
// 					}
// 					else{
// 						 $(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					}
// 				}
// 			}
		</script>
		<?php
	}
	public function step6($array){
		// print_r($array);
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
					<div class="myPerso flex" id="_1">
						<div class="left">Certified ID Copy</div>
						<div class="right" id="_1_1">
							<?php  if($this->TertiaryApplications->isUploaded1($array)){
								?>
									<h5 style="color:green;">FILE_ALREADY_UPLOADED.</h5>
									<script>
										$(document).ready(function(){
											$("#_2").removeAttr("style");
										});
										
									</script>
								<?php
								$t=true;
							}
							else{
								?>
								    <label class="label">Certified ID Copy</label>
									<input type="file" id="idcopy" name="file" required="" placeholder="upload Your ID Copy"></div>
								<?php
							}
							?>
					</div>
					<div id="erroridcopy" hidden></div>
					<div class="myPerso flex " id="_2" style="display: none;">

						<div class="left">Certified Grade11/Matric Final Results</div>
						<div class="right" id="_2_2">
							<?php if($this->TertiaryApplications->isUploaded2($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									<script>
										$("#_3").removeAttr("style");
									</script>
								<?php
							}
							else{
								?>
								    <label class="label">Certified Grade11/Matric Final Results</label>
									<input type="file" id="finalresults" name="file" required="" placeholder="Upload Results"></div>
								<?php
							}
							?>
						
					</div>
					<div id="errorfinalresults" hidden></div>
					<div class="myPerso flex" id="_3" style="display: none;">
						<div class="left">Certified Proof Of Resident</div>
						<div class="right" id="_3_3">
							<?php if($this->TertiaryApplications->isUploaded3($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									<script>
										$("#_4").removeAttr("style");
									</script>
								<?php
							}
							else{
								?>
								    <label class="label">Certified Proof Of Resident</label>
									<input type="file" id="proofresident" name="file" required="" placeholder="Upload Proof Of Resident"></div>
								<?php
							}
							?>
					</div>
					<div id="errorproofresident" hidden></div>
					<div class="myPerso flex" id="_4" style="display: none;">
						<div class="left">Certified Guardian ID Copy</div>
						<div class="right" id="_4_4">
							<?php if($this->TertiaryApplications->isUploaded4($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									
								<?php
							}
							else{
								?>
								    <label class="label">Certified Guardian ID Copy</label>
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
		<script>
// 			$(document).on('change','#idcopy',function(){
// 				$("#erroridcopy").removeAttr("hidden");
// 				$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('idcopy').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#erroridcopy").removeAttr("hidden");
// 					$("#erroridcopy").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("idcopy").files[0]);
// 					$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("erroridcopy","erroridcopy");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#erroridcopy").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#erroridcopy").attr("style","color:red;");
// 								$("#erroridcopy").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#erroridcopy").attr("hidden",true);
// 								$("#_1_1").attr("style","color:green;");
// 								$("#_1_1").html("SUCCESSFULY UPLOADED");
// 								$("#_2").removeAttr("hidden");
								
// 							}
// 						}
// 					});
// 				}
// 			});
// 			$(document).on('change','#finalresults',function(){
// 				$("#errorfinalresults").removeAttr("hidden");
// 				$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('finalresults').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#errorfinalresults").removeAttr("hidden");
// 					$("#errorfinalresults").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("finalresults").files[0]);
// 					$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("errorfinalresults","errorfinalresults");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#errorfinalresults").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#errorfinalresults").attr("style","color:red;");
// 								$("#errorfinalresults").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#errorfinalresults").attr("hidden",true);
// 								$("#_2_2").attr("style","color:green;");
// 								$("#_2_2").html("SUCCESSFULY UPLOADED");
// 								$("#_3").removeAttr("hidden");
								
// 							}
// 						}
// 					});
// 				}
// 			});
// 			$(document).on('change','#proofresident',function(){
// 				$("#errorproofresident").removeAttr("hidden");
// 				$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('proofresident').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#errorproofresident").removeAttr("hidden");
// 					$("#errorproofresident").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("proofresident").files[0]);
// 					$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("proofresident","proofresident");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#errorproofresident").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#errorproofresident").attr("style","color:red;");
// 								$("#errorproofresident").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#errorproofresident").attr("hidden",true);
// 								$("#_3_3").attr("style","color:green;");
// 								$("#_3_3").html("SUCCESSFULY UPLOADED");
// 								$("#_4").removeAttr("hidden");
								
// 							}
// 						}
// 					});
// 				}
// 			});
// 			$(document).on('change','#guardianid',function(){
// 				$("#errorguardianid").removeAttr("hidden");
// 				$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('guardianid').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#errorguardianid").removeAttr("hidden");
// 					$("#errorguardianid").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("guardianid").files[0]);
// 					$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("guardianid","guardianid");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#errorguardianid").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#errorguardianid").attr("style","color:red;");
// 								$("#errorguardianid").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#errorguardianid").attr("hidden",true);
// 								$("#_4_4").attr("style","color:green;");
// 								$("#_4_4").html("SUCCESSFULY UPLOADED");
// 								$("#_submitFiles").removeAttr("hidden");
// 								$("#_submit_").html("<img style='width:8%;' src='../../img/processor.gif'> Navigating to next step...");


// 								loader("apply");
								
// 							}
// 						}
// 					});
// 				}
// 			});
		</script>

		<?php
	}
	public function step7($array){
		?>
		<style>
			.container .collapse .match{
				margin-top: 2%;
			}
		</style>
		<?php
			// $sql="select*from universities order by rand()";
			$response=$this->TertiaryApplications->getUniversities();
			foreach($response as $row){
			
				$uni_id=$row["id"];
				$uni_name=$row['uni_name'];
				?>
					<div class="container" style="width:100%;margin-top:-10;padding:10px;">
					  <button type="button" style="width:100%;padding: 10px 0;" class="btn btn-info" data-toggle="collapse" data-target="<?php echo "#_".$uni_id;?>"><?php echo $uni_name; ?></button>
					  <div id="<?php echo "_".$uni_id;?>" class="collapse">
							<div class="container match">
								<?php 
								self::getAllFaculties($uni_id,$uni_name,$array);
								?>
							</div>
					  </div>
					</div>

				<?php
			}
		
	}
	public function getAllFaculties($uni_id,$uni_name,$array){
		$response=$this->TertiaryApplications->getAllFacultiesFromUni($uni_id);
		if(count($response)==0){
			echo "<h5 style='color:red;'>No faculties Available for ".$uni_name."</h5";
		}
		else{
			foreach($response as $row){
				$faculty_id=$row['faculty_id'];
				$faculty_name=$row["faculty_name"];
				?>
				<button style="width:100%;margin-top:2%;background-color:green;overflow-wrap: break-word;word-wrap: break-word;hyphens: auto;" type="button" class="btn btn-info" data-toggle="collapse" data-target="<?php echo "#_".$faculty_id;?>"><?php echo $faculty_name;?></button>
				<div id="<?php echo "_".$faculty_id;?>" class="collapse">
					<div class="container match" style="width:100%;padding: 5px 0;">
					  <?php
					  self::courses($uni_id,$uni_name,$faculty_id,$faculty_name,$array);
					  ?>
					</div>
				</div>
				<?php
			}
		}
		
	}
	
	public function courses($uni_id,$uni_name,$faculty_id,$faculty_name,$array){
		// global $conn;
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
		// $sql="select*from courses where uni_id=? AND faculty_id=?";
		$response=$this->TertiaryApplications->getCoursesFromUniFaculty($uni_id,$faculty_id);
		if(count($response)==0){
			echo "<h5 style='color:red;'>No Courses Available for Faculty of ".$faculty_name." @ ".$uni_name.",</h5";
		}
		else{
			foreach($response as $row){
				$course_id=$row['course_id'];
				$course_name=$row["course_name"];
				if($this->TertiaryApplications->issAlreadyApplied($course_id,$this->TertiaryApplications->getApplicationId($array['std_id']))){?>
					<button type="button" class="btn btn-info" data-toggle="collapse" style="width:100%;padding:3px;margin-top:2%;" data-target="<?php echo "#_".$course_id;?>" ><?php echo $course_name;?></button>
					<div id="<?php echo "_".$course_id;?>" class="collapse" style='padding: 10px 0;'>
						<div class="container match" style="width:100%; background-color: #f3f3;color:#000;border-radius: 10px; padding:10px 0;">
							<h2 style="color:#45f3ff;background-color:navy;">YOU ALREADY HAVE APPLIED FOR <?php echo $course_name;?></h2>	
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
						  			    <label class="label">Academic Program</label>
						  				<select id="course_name">
						  					<option value="<?php echo $course_id;?>"><?php echo $course_name;?></option>
						  				</select>
						  			</div>
						  			<div class="item">
						  			    <label class="label">Mode Of Attendance</label>
						  				<select id="mode_of_attendance">
						  					<option value="Full Time">Full Time</option>
						  					<option value="Part Time">Part Time</option>
						  				</select>
						  			</div>
						  			<div class="item">
						  			    <label class="label">Year Of Study</label>
						  				<select id="year_of_study">
						  					<option value="1st Year">1st Year</option>
						  					<option value="2nd Year">2nd Year</option>
						  				</select>
						  			</div>
						  			<div class="item">
						  			    <label class="label">Campus</label>
						  				<select id="campus_id">
						  				    
						  					<?php $this->TertiaryApplications->studyCampus($course_id);?>
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
								$(id).html("<small><img style='width:8%;' src='../img/processor.gif'> <span style='color:green;'>Analysing Data...</span></small>");
								const uni_id="<?php echo $uni_id ?>";
								const uni_name="<?php echo $uni_id ?>";
								const faculty_id="<?php echo $faculty_id ?>";
								const faculty_name="<?php echo $faculty_name ?>";
								const course_id="<?php echo $course_id ?>";
								const course_name=$("#course_name").val();
								const mode_of_attendance=$("#mode_of_attendance").val();
								const year_of_study=$("#year_of_study").val();
								const campus_id=$("#campus_id").val();
								$(id).html("<small><img style='width:8%;' src='../img/processor.gif'> <span style='color:green;'>Processing Data...</span></small>");
								// console.log("Log Check 1382"+id);
								$.ajax({
									url:"./controller/ajaxCallProcessor.php",
									type:"POST",
									data:{uni_id:uni_id,uni_name:uni_name,faculty_id:faculty_id,faculty_name:faculty_name,course_id:course_id,course_name:course_name,mode_of_attendance:mode_of_attendance,year_of_study:year_of_study,campus_id:campus_id
									},
									cache:false,
									beforeSend:function(){
										// console.log("Log Check 1382"+id+" Sending Data");
										$(id).html("<small><img style='width:8%;' src='../img/processor.gif'> <span style='color:green;'>Submitting Data...</span></small>");
									},
									success:function(e){

										response = JSON.parse(e);
										// console.log("Log Check 1382"+id+" Recieving Reasponse");
										// console.log(response);
										if(response['responseStatus']==='F'){
											$(id).html("ERROR: REPORT THIS ERROR :"+response['responseMessage']);
											$(id).attr("style","color:red;background-color:#000;");
											$(error).removeAttr("hidden");
											$(error).attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
											$(error).html("REPORT THIS ERROR <br>Error 320 : "+response['responseMessage']);
										}

										else if(response['responseMessage']==='NEXT'){
											// console.log(e.length+" loader to change");
											$(id).html("Application Submitted!!");
											$(id).attr("disabled",true);
											$(id).html("<small><img style='width:8%;' src='../img/processor.gif'> <span style='color:green;'>Redirecting...</span></small>");
											console.log("changing load");
											loader("apply");
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
											// console.log(response);
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
	
	public function step8($array){
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
				color: #45f3ff;
				width: 20%;
				margin-top: 2%;
			}
			.btn:hover{
				background-color: forestgreen;
				color: #45f3ff;
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
            Further to the above consent, I understand that my personal information is also public in
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
		<button class="btn" type="button" id="acceptcondition" onclick="acceptConditions('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
		<div id="acceptconditionerror" hidden></div>
		<script>
// 			function acceptConditions(applicationidStep8,my_id_step8){
// 				const accept=$("#accept").val();
// 				if(accept=="Yes"){
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:{
// 							accept:accept,applicationidStep8:applicationidStep8,my_id_step8:my_id_step8
// 						},
// 						cache:false,
// 						beforeSend:function(){
// 							$("#acceptconditionerror").removeAttr("hidden").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting Data...</span></small>");
// 						},
// 						success:function(e){
// 							console.log(e);
// 							if(e.length==1){
// 								$("#acceptconditionerror").attr("style","color:#45f3ff;background:green;").html("Successfully Saved..");
// 								loader("apply");
// 							}
// 							else{
// 								$("#acceptconditionerror").attr("style","color:red;").html(e);
// 							}
// 						}
// 					});
// 				}
// 				else{
// 					$("#acceptconditionerror").attr("style","color:red;").html("Cannot Proceed until you accept Ts n Cs");
// 				}
// 			}
		</script>
		<?php
	}
	
    
    
    
	public function step9($array){
		global $conn;
		$std_id=$array['std_id'];
		//print_r($this->getApplicationId($array['std_id']));echo'----';
	    $amountToPay=$this->matricUpgrade->getAmountToPay($this->TertiaryApplications->getApplicationId($array['std_id']));
	    
	    if($amountToPay=="R220.00"){
            $amountToPay="220.00";
        }
        elseif($amountToPay=="R220.00"){
            $amountToPay="220.00";
        }
        elseif($amountToPay=="R220.00"){
            $amountToPay="220.00";
        }
        else{
            $amountToPay="220.00";
        }
        $tax=($amountToPay*0.15)+3;
        $amountToPay+=$tax;
	    $applicant_id=$this->TertiaryApplications->getStudentId($array['std_id']);
	    $school=$this->TertiaryApplications->getSchoolId($applicant_id);
		if($this->TertiaryApplications->isAcceptedTerms($this->TertiaryApplications->getApplicationId($array['std_id']))){
// 			$amountToPay=$this->getAmountToPay($this->getApplicationId($array['my_id']));
			if(isset($_GET['payment'])){
                    $std_id=$array['std_id'];
            	   $amountToPay=$this->matricUpgrade->getAmountToPay($this->TertiaryApplications->getApplicationId($array['std_id']));
            	    $applicant_id=$this->TertiaryApplications->getStudentId($array['std_id']);
            	    $school=$this->TertiaryApplications->getSchoolId($applicant_id);
                    $step1_info=$this->TertiaryApplications->getStep1Info($applicant_id);
            		$step2_info=$this->TertiaryApplications->getStep2Info($applicant_id);
            		$step3_info=$this->TertiaryApplications->getStep3Info($applicant_id);
            		$step4_info=$this->TertiaryApplications->getStep4Info($applicant_id);
            		$step5_info=$this->TertiaryApplications->getStep5Info($applicant_id);
                    if($amountToPay=="R220.00"){
                        $amountToPay="220.00";
                    }
                    elseif($amountToPay=="R220.00"){
                        $amountToPay="220.00";
                    }
                    elseif($amountToPay=="R220.00"){
                        $amountToPay="220.00";
                    }
                    else{
                        $amountToPay="220.00";
                    }
                    $tax=($amountToPay*0.15)+3;
	                $amountToPay=$amountToPay+=$tax;
                    $passPhrase = 'msiziMzobe98';
                    $amount_net=$amountToPay-2.48;
                    $data = array(
                        'merchant_id' => '18152361',
                        'merchant_key' => '2ammma77nrah4',
                        'return_url' => 'https://netchatsa.com/?apply',
                        'cancel_url' => 'https://netchatsa.com/cancel.php',
                        'notify_url' => 'https://netchatsa.com/notify.php',
                        'name_first'=>$step2_info['fname'],
                        'name_last'=>$step2_info['title']." ".$step2_info['initials']." ".$step2_info['lname'],
                        'email_address'=>$step3_info['email'],
                        'm_payment_id' => $step2_info['idnumber'],
                        'amount' => number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' ),
                        'item_name' => 'NETCHATSA ADMIN FEE FOR TERTIARY APPLICATION'
                        
                    );
                        // Generate signature (see Custom Integration -> Step 2)
                    $data["signature"] = $this->payFastIntegration->generateSignature($data, $passPhrase);
                    $pfParamString = $this->payFastIntegration->dataToString($data);
                    //echo 'Param : '.$pfParamString;
                    
                    $identifier = $this->payFastIntegration->generatePaymentIdentifier($pfParamString);
                    $data['pf_payment_id'] = '';
                    $data['item_description'] = 'THIS PAYMENT IS MADE ONLY FOR TERTIARY APPLICATION. IT IS NOT AN APPLICATION FEE. IT IS AN ADMINISTRATION FEE.';
                    $data['amount_gross'] = number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' );
                    $data['amount_fee'] = 2.48;
                    $data['amount_net'] = $amount_net;
                    $data['payment_status'] = 'PAID';
                    if($identifier!==null){
                           ?>
                           <script>
                              window.payfast_do_onsite_payment({"uuid":"<?php echo $identifier;?>"}, function (result){
                                  if(result){
                                    //   window.location=("./?_=apply&Processing=true");
                                    const std_id="<?php echo $std_id;?>";
                                    const amountToPay="<?php echo $amountToPay;?>";
                                    const pfData ='<?php echo json_encode($data);?>';
                                    const pfParamString = '<?php echo $pfParamString;?>';
                                    $(".sudoCodeoSitePayment").removeAttr("hidden");
                                    $.ajax({
                                		url:'../src/forms/app/success.php',
                                		type:'post',
                                		data:{std_id:std_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                                		success:function(e){
                                		    response = JSON.parse(e);
		                    				if(response['responseStatus']==='S'){
                                		        $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".sudoCodeoSitePayment").html("Payment Successfull, Processing Request...");
                                		        loader("apply");
                                		    }
                                		    else{
                                		        $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".sudoCodeoSitePayment").html(response['responseMessage']);
                                		    }
                                			
                                		}
                                    });
                                  }
                                  else{
                                      //window.location=("./?_=apply&failedProcessing=true");
                                      $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                	  $(".sudoCodeoSitePayment").html("Payment Cancelled ");
                                      
                                  }
                              });
                            </script>
                               <?php
                   }
                   else{
                       echo'<div style="width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;">
			            Could not Identify your payment request {'.$identifier.'}
			        </div>';
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
					color: #45f3ff;
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
				<h2 >To Process Your Applications Please Pay <?php echo "R".$amountToPay;?> Admin Fee.</h2>
			</div>
			<hr>
			<!--<div class="payCash">-->
			<!--	<button class="btn" id="paycash">CASH PAYMENT</button>-->
			<!--</div>-->
			<!--<hr>-->
			<div class="payCard" >
				<button class="btn" id="paycard" onclick="loader('apply&payment')">
                    <input type="submit" name="paynow" value="PAY-NOW <?php echo 'R'.$amountToPay;?>">
                </button>
			</div>
			<hr>
			
			<!--<div class="payCard_online" disabled hidden>-->
			<!--	<form action="?payment" method="post">-->
   <!--                <input type="submit" name="paynow" value="PAY-NOW <?php //echo 'R'.$amountToPay;?>">-->
   <!--             </form>-->
			<!--</div>-->
			<!--<script>-->
			<!--    function paycardNotice(){-->
			<!--        $(".payCard_online").removeAttr("disabled").removeAttr("hidden");-->
			<!--    }-->
			<!--</script>-->
			<?php
			    if(isset($_GET['failedProcessing'])){
			        ?>
			        <div style="width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;">
			            Payment Failed
			        </div>
			        <?php
			    }
			?>
			    
			        <div hidden class="sudoCodeoSitePayment" style="width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;">
			            Payment Successfull, Processing Request...
			        </div>
			<?php
		}
		else{
			echo "no";exit();
		}
	}
	
	public function step10($array){
		global $conn;
		$paymentStatusDisplay="";
		$applicant_id=$this->TertiaryApplications->getApplicationId($array['std_id']);
		$paymentStatus=$this->TertiaryApplications->getPaymentStatus($applicant_id);
		if($paymentStatus){
		    if($paymentStatus=="PENDING"){
		        $paymentStatusDisplay="<h5 style='color:red;'><span style='color:#45f3ff;'>PAYMENT: </span>".$paymentStatus."</h5>";
		    }
		    else{
		        $paymentStatusDisplay="<h5 style='color:green;'><span style='color:#45f3ff;'>PAYMENT: </span>".$paymentStatus."</h5>";
		    }

		    // echo $paymentStatusDisplay;
			
		
    		$step1_info=$this->TertiaryApplications->getStep1Info($applicant_id);
    		$step2_info=$this->TertiaryApplications->getStep2Info($applicant_id);
    		$step3_info=$this->TertiaryApplications->getStep3Info($applicant_id);
    		$step4_info=$this->TertiaryApplications->getStep4Info($applicant_id);
    		$step5_info=$this->TertiaryApplications->getStep5Info($applicant_id);
    		
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
    		        color:#45f3ff;
    		        background-color:#e8491d;
    		        border:2px solid #45f3ff;
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
    		        <div style="text-align:left;" ><?php $trackApplication=$this->TertiaryApplications->isApplicationActive($applicant_id);
	    		        $rr="";
	    		        if(empty($trackApplication)){
	    		        	$rr="<span class='badge badge-danger text-white text-center'>NOT STARTED YET</span>";
	    		        }
	    		        elseif($trackApplication['is_application_done']=="N") {
	    		        	$consultant=$this->TertiaryApplications->getConsultant($trackApplication['startedby']);
	    		        	$rr="IN PROGRESS by ".$consultant;
	    		        }
	    		        else{
	    		        	$consultant=$this->TertiaryApplications->getConsultant($trackApplication['startedby']);
	    		        	$rr="SUBMITTED BY ".$consultant;
	    		        }
	    		        echo $paymentStatusDisplay."".$rr;?>
	    		    </div>
    		    </div>
    		    <br>
    		    <div class="row" style="width:100%;">
                  <div class="col-md-12 mb-3" style="width:100%;">
                    <div class="card">
                      <div class="card-header" style="background-color:#212121;border-bottom:1px solid #45f3ff;">
                        <span><i class="bi bi-table me-2"></i></span>Application Table
                      </div>
                      <div class="card-body" style="background-color:#212121;">
                        <div class="table-responsive" style="background-color:#212121;border:1px solid #45f3ff;">
                          <table
                            id="example"
                            class="table table-striped data-table"
                            style="width: 100%;background-color:#212121;color:#45f3ff"
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
                                                background-color:red;color:#45f3ff;padding:2px;
                                            }
                                            .ramButtonModalView:hover{
                                                background-color:#212121;
                                                border:#45f3ff;
                                                color:#45f3ff;
                                            }
                                        </style>
                              <?php 
                              $response=$this->TertiaryApplications->getApplicationsStatments($applicant_id);
                              
                              foreach($response as $row){
                              	  // print_r($row);
                                  $institution =$this->TertiaryApplications->getInstitutionName($row['uni_id']);
                                  $course =$this->TertiaryApplications->geCourse($row['course_id']);
                                  ?>
                                  <tr style='background:#212121;'>
                                    <td style="color:#45f3ff;"><?php echo $institution;?></td>
                                    <td style="color:#45f3ff;"><?php echo $course;?></td>
                                   
                                    <td><button 
                                    		class="btn ramButtonModalView" 
                                    		data-toggle="modal"
                            				data-target="#Pera_<?php echo $row['uni_id']."-".$row['applicationid'];?>"
                                    	>view</button></td>
                               
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
                                $response=$this->TertiaryApplications->getFacultiesOfUni($uni);//getAllDataSafely("select*from faculties where uni_id=?","s",[$uni])??[];
                                foreach($response as $row){
                                    ?>
                                    <option value="<?php echo $row['faculty_id'];?>"><?php echo $row['faculty_name'];?></option>
                                    <?php
                                }
                                ?>
                                
                            </select>
                            <br><br>
                            <button class="btn" name="addBtnb" style="border:1px solid #45f3ff;color:white;">Add Faculty</button>
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
                        $response=$this->TertiaryApplications->getCoursesFromUniFaculty($uni,$faculty);
                        foreach($response as $row){
                            ?>
                            <option value="<?php echo $row['course_id'];?>"><?php echo $row['course_name'];?></option>
                            <?php
                        }
                        ?>
                        
                    </select>
                    <br><br>
                    <button class="btn bedant" name="addBtnb" style="border:1px solid #45f3ff;color:#45f3ff;">Add Course</button>
                    <script>
                        $(document).ready(function(){
                            $(".bedant").click(function(){
                                const a=$(".a").val();
                                const b=$(".b").val();
                                const c=$(".c").val();
                                console.log(a+" "+b+" "+c);
                                if(c!=""){
                                    $(".bedant").removeAttr('hidden');
                                    $(".bedant").html("<img style='width:4%;color:#45f3ff;' src='../img/processor.gif'> Adding Course...");
                                    $.ajax({
	                            		url:'./controller/ajaxCallProcessor.php',
	                            		type:'post',
	                            		data:{a:a,b:b,c:c},
	                            		success:function(e){
	                            		    if(e.length<=2){
	                            		        $(".bedant").attr("style","background-color:green;color:#fff;");
	                            		        $(".bedant").html("Course Added Successfuly...");
	                            		        loader("apply");
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
                    <button class="btn btn-mob" onclick="DynamicDomeSmallModal('addTertiaryApplication','addTertiaryApplicationModal')">Add Application</button>
                </div>
                <div class="fallbackEmptyOrError"></div>
                    <?php
                }
                ?>                
                <br>
                <p style="color:red;border:1px solid red;font-size:11.5px;">NOTE that NSFAS & Relavant Bursary Applications will be displayed here once application process has been started with SOON to open Bursary offering Institutions.</p>
                <div class="runBursaryUp">
                	
                </div>
    		</div>
    		<script>
    			loadQuery('.runBursaryUp','../src/forms/app/displayBursaryApplication.php');
    		</script>
		<?php
		}
		else{
		    echo "YOU HAVE NOT MADE PAYMENT!!";	
		}
	}
}

?>