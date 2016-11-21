<?php
/**
 * Template Name: Payment Form
 */

get_header(); ?>
<?php
global $wpdb;
if(isset($_GET['mem_id']) && $_GET['mem_id']!=''){
$memid = base64_decode($_GET['mem_id']);
$mem_query = 'select * from reedemer_membership where id='.$memid;
$mem_result = $wpdb->get_row($mem_query);
$price = $mem_result->membership_price;
}

if(isset($_GET['off_id']) && $_GET['off_id']!=''){
$offid = base64_decode($_GET['off_id']);
$off_query = 'select * from reedemer_offer where id='.$offid;
$off_result = $wpdb->get_row($off_query);
$price = $off_result->pay_value;
}

?>
<?php
	$amount = $price;
	$referenceNumber = 0;
	$responseMessage = "Declined";
	function isPost($server){
		return (strtoupper($server['REQUEST_METHOD']) == 'POST');
	}
	
	function requestSale($token, $amount){
		global $referenceNumber, $responseMessage;
		$client = new SoapClient('https://ps1.merchantware.net/Merchantware/ws/retailTransaction/v4/credit.asmx?WSDL', array('trace' => true));

		$response = $client->SaleVault(
			array(
				'merchantName'           => 'TEST',
				'merchantSiteId'         => 'XXXXXXXX',
				'merchantKey'            => 'XXXXX-XXXXX-XXXXX-XXXXX-XXXXX',
				'invoiceNumber'          => '123',
				'amount'                 => $amount,
				'vaultToken'             => $token,
				'forceDuplicate'         => 'true',
				'registerNumber'         => '123',
				'merchantTransactionId'  => '1234'
			)
		);
		$result = $response->SaleVaultResult;
		$responseMessage = $result->ApprovalStatus;
		$amount = $result->Amount;
		$referenceNumber = $result->Token;
	}
?>


	<?php 
	if(isPost($_SERVER) && $_POST["TokenHolder"]){
		
		requestSale($_POST["TokenHolder"], $amount);
	}
	?>

	<div class="container">
		<div class="page-header">
			<h1>Checkout</h1>    
		</div>       
    </div>
	<div class="container margin-top-10 card-entry-form">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Order Details</div>
			<div class="panel-body">
				$<?php echo $amount; ?>
			</div>
		</div>
		<?php if($referenceNumber !== 0): ?>    
       <div id="ResponseMessageContainer" class="panel panel-success panel-success">
            <div class="panel-heading">Order Results</div>
            <div class="panel-body">
                <p><strong>Status: </strong><span id="ResponseMessage">Approved</span></p>
                <p><strong>Reference #: </strong><span id="ResponseRef"><?php echo $referenceNumber;?></span></p>
            </div> 
		</div>
		<?php else: ?>
		<div id="CheckoutPanel" class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Card Information</div>
				<div class="panel-body">
					<div id="LoadingImage" class="form-loading" style="display:none;">
						<img src="<?php echo get_template_directory_uri();?>/content/wait24.gif" />
					</div>
					<form method="post" id="PaymentForm" class="form-horizontal" role="form">
						<div class="form-group">
							<label for="CardHolder" id="CardholderLabel" class="control-label col-sm-3">Card Holder Name</label>
							<div class="col-sm-9">
								<input name="CardHolder" type="text" id="CardHolder" class="form-control" placeholder="Enter card holder name" data-cayan="cardholder" />
							</div>
						</div>
						<div class="form-group">
							<label for="CardNumber" id="CardLabel" class="control-label col-sm-3">Card Number</label>
							<div class="col-sm-9">
								<input name="CardNumber" type="text" id="CardNumber" class="form-control" placeholder="Enter card number" data-cayan="cardnumber" />
							</div>
						</div>
						<div class="form-group">
							<label for="ExpirationMonth" id="ExpirationDateLabel" class="control-label col-sm-3">Expiration Date</label>
							<div class="col-sm-4">
								<select name="ExpirationMonth" id="ExpirationMonth" data-cayan="expirationmonth" class="form-control">
									<option value="01">01 January</option>
									<option value="02">02 February</option>
									<option value="03">03 March</option>
									<option value="04">04 April</option>
									<option value="05">05 May</option>
									<option value="06">06 June</option>
									<option value="07">07 July</option>
									<option value="08">08 August</option>
									<option value="09">09 September</option>
									<option value="10">10 October</option>
									<option value="11">11 November</option>
									<option selected="selected" value="12">12 December</option>
								</select>
							</div>
							<div class="col-sm-5">
								<select name="ExpirationYear" id="ExpirationYear" data-cayan="expirationyear" class="form-control">
									<option value="15">2015</option>
									<option selected="selected" value="16">2016</option>
									<option value="17">2017</option>
									<option value="18">2018</option>
									<option value="19">2019</option>
									<option value="20">2020</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="CVV" id="CVVLabel" class="control-label col-sm-3">CVV/CVS</label>
							<div class="col-sm-9">
								<input name="CVV" type="text" id="CVV" class="form-control" placeholder="Enter the 3 or 4 digit CVV/CVS code" data-cayan="cvv" />
							</div>
						</div>
						<div class="form-group">
							<label for="StreetAddress" id="StreetAddressLabel" class="control-label col-sm-3">Street Address</label>
							<div class="col-sm-9">
								<input name="StreetAddress" type="text" id="StreetAddress" class="form-control" placeholder="Enter street address" data-cayan="streetaddress" />
							</div>
						</div>
						<div class="form-group">
							<label for="ZipCode" id="ZipLabel" class="control-label col-sm-3">Zip code</label>
							<div class="col-sm-9">
								<input name="ZipCode" type="text" id="ZipCode" class="form-control" placeholder="Enter 5-digit zip-code" data-cayan="zipcode" />
							</div>    
						</div>
						<div class="form-actions">
							<input type="button" name="SubmitButton" value="Complete Checkout" id="SubmitButton" class="btn btn-primary" />
							<input type="button" name="SaleButton" value="Submit Sale" onclick="javascript:__doPostBack(&#39;SaleButton&#39;,&#39;&#39;)" id="SaleButton" class="btn btn-primary" style="display: none;" />
						</div>
						<div id="TokenMessageContainer" class="alert" style="display:none;">
							<span id="tokenMessage" data-cayan="tokenMessage"></span>
						</div>
						<input name="TokenHolder" type="text" id="TokenHolder" style="display:none;" />
					</form>
				</div>
			</div>
		</div>
		<?php endif; ?>
    </div>

 <script src="https://ecommerce.merchantware.net/v1/CayanCheckout.js" type="text/javascript"></script>   
<script>
    // set credentials to enable use of the API.
    CayanCheckout.setWebApiKey("4QKKM3SSRJJH550C");

    function clearTokenMessageContainer(tokenMessageContainer) {
        tokenMessageContainer.removeClass('alert-danger');
        tokenMessageContainer.removeClass('alert-success');
        tokenMessageContainer.removeClass('alert-info');
    }
	
    function toggleForm() {
        $("#PaymentForm").toggle();
        $("#LoadingImage").toggle();
    }

    // client defined callback to handle the successful token response
    function HandleTokenResponse(tokenResponse) {
        var tokenHolder = $("#TokenHolder");
		
        if (tokenResponse.token !== "") {
            tokenHolder.val(tokenResponse.token);
            $("input#tokenHolder").val(tokenResponse.token);
        }else{
			toggleForm();
		}

        // Show "waiting" gif
        $("#SaleButtonSpan").html("<img src='<?php echo get_template_directory_uri();?>/content/wait24.gif' />");
		$("#PaymentForm").submit();
    }

    // client-defined callback to handle error responses
    function HandleErrorResponse(errorResponses) {
        toggleForm();
        var errorText = "";
        for (var key in errorResponses) {
            errorText += " Error Code: " + errorResponses[key].error_code + " Reason: " + errorResponses[key].reason + "\n";
        }
        alert(errorText);
    }

    // create a submit action handler on the payment form, which calls CreateToken
    $("#SubmitButton").click(function (ev) {
        toggleForm();
        CayanCheckout.createPaymentToken({ success: HandleTokenResponse, error: HandleErrorResponse });

        // AJAX SOAP request here

        ev.preventDefault();
    });

</script>

	
<?php get_footer(); ?>
