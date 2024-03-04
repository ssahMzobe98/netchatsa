<?php
include_once("./vendor/autoload.php");
use Src\Classes\Region;

$region = Region::getSelectRegion();
$provice = Region::getSelectProvince();
// Define the base URL for GeoNames API
// $baseURL = 'http://api.geonames.org/searchJSON';

// // Parameters for the API request
// $params = [
//     'country' => 'ZA',  // Country code for South Africa
//     'featureClass' => 'P',  // Cities and towns
//     'maxRows' => 1000,  // Maximum number of results (adjust as needed)
//     'username' => 'demo',  // Your GeoNames username
// ];

// // Construct the API request URL
// $requestURL = $baseURL . '?' . http_build_query($params);

// // Perform the API request
// $response = file_get_contents($requestURL);

// // Parse the JSON response
// $data = json_decode($response, true);
// echo "<pre>";print_r($data);echo"</pre>";
// // Extract city names from the response
// $cities = [];
// if (isset($data['geonames'])) {
//     foreach ($data['geonames'] as $cityData) {
//         $cities[] = $cityData['name'];
//     }
// }

// // Output the list of cities
// foreach ($cities as $city) {
//     echo $city . "<br>";
// }

?>
<input type="checkbox" id="chk" aria-hidden="true">

<div class="signup">
	<div>
		<label for="chk" aria-hidden="true">Verify</label>

		<input type="number" class="otp" placeholder="OTP" required="">
		<select class="gender">
			<option value=''>-- Select Gender --</option>
			<option value='Male'>Male</option>
			<option value='Female'>Female</option>
		</select>
		<select class="region">
			<?php echo $region;?>
		</select>
		<input type="date" class="dob" placeholder="Date of Bith" required="">
		<input type="text" class="address" placeholder="Enter Address" />
		<select class="provice">
			<?php echo $provice;?>
		</select>
		<button onclick="completeDetails()">Sign up</button>
		<div style='font-size: 8px;text-align: center;color:white;'>By Signing up you agree to our user TsnCs.</div>
		<div class="errorResolutionCompleteDetails" hidden></div>
	</div>
</div>

<div class="login">
	<div>
		<label for="chk" aria-hidden="Fort and missedby">Login</label>
		<input type="email" class="email" missedby placeholder="Email" required="">
		<input type="password" class="pswd" placeholder="Password" required="">
		<button onclick="login()">Login</button>
	</div>
	<div style='font-size: 8px;text-align: center;color:red;'>By logging in you agree to our user TsnCs.</div>
	<div class="errorResolution" hidden></div>
</div>