<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03-07-17
 * Time: 02:28 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller {
	private $api_content;

	public function __construct() {
		//$this->middleware('auth');
		$paypal_config = \Config::get('paypal');
		$this->api_content = new ApiContext(new OAuthTokenCredential($paypal_config['client_id'], $paypal_config['secret']));
		$this->api_content->setConfig($paypal_config['settings']);
	}

	public function Payment() {
		$name = 'Drone 3.5';
		$price = 350;
		$description = "Capacidad de 3km distancia camara hd";
		$currency = 'USD';
		$shipping = 2.3;
		$total = $price + $shipping;

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item = new Item();
		$item->setName($name)
			->setCurrency($currency)
			->setDescription($description)
			->setQuantity(1)
			->setPrice($price);

		$items_list = new ItemList();
		$items_list->setItems([$item]);

		$details = new Details();
		$details->setSubtotal($price)
			->setShipping($shipping);

		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($items_list)
			->setDescription("Payment for Paypal Laravel App Store");

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(url('payment/status'))
			->setCancelUrl(url('/payment/status/cancel'));

		$payment = new Payment();
		$payment->setIntent("sale")
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions([$transaction]);

		try {
			$payment->create($this->api_content);
		} catch (PayPalConnectionException $e) {
			die($e);
		}
		return redirect($payment->getApprovalLink());
	}

	public function PaymentStatus() {
		$paymentId = Input::get('paymentId');
		$token = Input::get('token');
		$payerID = Input::get('PayerID');

		if (empty($paymentId) && empty($token) && empty($payerID)) {
			echo 'Hubo un error al pagar';
		}
		$payment = Payment::get($paymentId, $this->api_content);
		$excecution = new PaymentExecution();
		$excecution->setPayerId($payerID);
		$response = $payment->execute($excecution,$this->api_content);

		if ($response->getState() == "approved") {
			return redirect('/payment/status/done');
		} else {
			return redirect('/payment/status/cancel');
		}
	}

	public function PaymentStatusDone() {
		return view('paypal.done');
	}

	public function PaymentStatusCancel() {
		return view('paypal.cancel');
	}

}