<!--  The entire list of Checkout fields is available at
 https://docs.razorpay.com/docs/checkout-form#checkout-fields -->

<form  id="paymentform" name="paymentform" action="<?php echo base_url('payment/success'); ?>" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $details['key']?>"
    data-amount="<?php echo $details['amount']?>"
    data-currency="INR"
    data-name="<?php echo $details['name']?>"
    data-image="<?php echo $details['image']?>"
    data-description="<?php echo $details['description']?>"
    data-prefill.name="<?php echo $details['prefill']['name']?>"
    data-prefill.email="<?php echo $details['prefill']['email']?>"
    data-prefill.contact="<?php echo $details['prefill']['contact']?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php echo $details['order_id']?>"
    <?php if ($details['display_currency'] !== 'INR') { ?> data-display_amount="<?php echo $details['amount']?>" <?php } ?>
    <?php if ($details['display_currency'] !== 'INR') { ?> data-display_currency="<?php echo $details['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <!--<input type="hidden" name="shopping_order_id" value="3456">-->
</form>
