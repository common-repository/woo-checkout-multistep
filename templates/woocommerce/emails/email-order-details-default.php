<?php
defined( 'ABSPATH' ) || exit; 
$text_align = is_rtl() ? 'right' : 'left'; ?>
<table class="td yeemail-woocommerce-style yeemail-table" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;border: 1px solid #e5e5e5;" border="1">
    <thead>
        <tr>
            <th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;border: 1px solid #e5e5e5;"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
            <th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;border: 1px solid #e5e5e5;"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
            <th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;border: 1px solid #e5e5e5;"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
        </tr>
    </thead>
    <tbody>
    <tr>
		<td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word" align="left">
		YeeMail Product</td>
		<td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif" align="left">
			1		</td>
		<td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif" align="left">
			<span><span>$</span>29.00</span>		</td>
	</tr>
    </tbody>
    <tfoot>
        <tr>
            <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left">Subtotal:</th>
            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><span><span>$</span>29.00</span></td>
        </tr>
        <tr>
            <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Payment method:</th>
            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">PayPal</td>
        </tr>
                            <tr>
            <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Total:</th>
            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><span><span>$</span>29.00</span></td>
        </tr>
    </tfoot>
	</table>