 <script type="text/javascript">
function customQuantitiesPayFast (formReference) {
formReference['amount'].value = formReference['amount'].value * formReference['custom_quantity'].value;
return true;
}
</script>
 <script type="text/javascript">
function actionPayFastJavascript ( formReference ) {
let shippingValidOrOff = typeof shippingValid !== 'undefined' ? shippingValid : true; 
let customValid = shippingValidOrOff ? customQuantitiesPayFast( formReference ) : false;
 if (typeof shippingValid !== 'undefined' && !shippingValid) {
return false;
}
if (typeof customValid !== 'undefined' && !customValid) {
return false;
}
return true;
 }
</script>
<form onsubmit="return actionPayFastJavascript( this );" name="PayFastPayNowForm" action="https://www.payfast.co.za/eng/process" method="post">
<input required type="hidden" name="cmd" value="_paynow">
<input required type="hidden" name="receiver" pattern="[0-9]" value="18152361">
<input type="hidden" name="return_url" value="https://netchatsa.com">
<input type="hidden" name="cancel_url" value="https://netchatsa.com">
<input type="hidden" name="notify_url" value="https://netchatsa.com">
<table>
<tr>
<td><label id="PayFastAmountLabel" for="PayFastAmount">Amount: </label></td>
<td><input required id="PayFastAmount" type="number" step=".01" name="amount" min="5.00" placeholder="5.00" value="5"></td>
</tr>
</table>

<table>
<tr>
<td><label for="custom_quantity">Quantity: </label></td>
<td><input required id="custom_quantity" type="number" name="custom_quantity" value="1"></td>
</tr>
</table>

<input required type="hidden" name="item_name" maxlength="255" value="abcd">
<input type="hidden" name="item_description" maxlength="255" value="ertyubn">
<table>
<tr>
<td colspan=2 align=center>
<input type="image" src="https://my.payfast.io/images/buttons/PayNow/Light-Large-PayNow.png" alt="Pay Now" title="Pay Now with Payfast">
</td>
</tr>
</table>
</form>