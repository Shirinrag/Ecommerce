<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="GQs7yium";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
           
		   }         
?>	
<!-- 
Array
(
    [mihpayid] => 5914153151
    [mode] => NB
    [status] => success
    [unmappedstatus] => captured
    [key] => Jhl5t4FM
    [txnid] => 88b4e73270099fa51671
    [amount] => 1.0
    [addedon] => 2016-11-13 16:12:25
    [productinfo] => DIRECT FARM PRODUCT
    [firstname] => Arvind Prajapati
    [lastname] => 
    [address1] => 
    [address2] => 
    [city] => 
    [state] => 
    [country] => 
    [zipcode] => 
    [email] => arvind.prajapati20@gmail.com
    [phone] => 9892066185
    [udf1] => 
    [udf2] => 
    [udf3] => 
    [udf4] => 
    [udf5] => 
    [udf6] => 
    [udf7] => 
    [udf8] => 
    [udf9] => 
    [udf10] => 
    [hash] => f48289c2c1f3feb1a044f518ccb02cc692ff721846bf506c5641d04ccc36d657859c109cdfa9380e2af968f6f5a851726bdff120352216289b0df6d405d01217
    [field1] => 
    [field2] => 
    [field3] => 
    [field4] => 
    [field5] => 
    [field6] => 
    [field7] => payee=PayU&CRN=INR&PRN=PAYUMONEY00133136119&ITC=5914153151_PAYUMONEY&AMT=1.00&PAID=Y&BID=1079756379
    [field8] => 
    [field9] => Successful Transaction
    [PG_TYPE] => ICICI
    [encryptedPaymentId] => 9B69DB6881EA9047B19B1BC678C9B6DB
    [bank_ref_num] => 1079756379
    [bankcode] => ICIB
    [error] => E000
    [error_Message] => No Error
    [amount_split] => {"PAYU":"1.0"}
    [payuMoneyId] => 124445161
    [discount] => 0.00
    [net_amount_debit] => 1
) -->