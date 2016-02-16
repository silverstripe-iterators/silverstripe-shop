<?php

/**
 * @package shop
 */
class OrderAdminPrintController extends Controller {
	
	private static $allowed_actions = array(
		'printorder'
	);

	public function printorder() {
		$id = $this->request->param('ID');

		if(!$id) {
			return $this->httpError(404);
		}

		$order = Order::get()->byId($id);

		if(!$order) {
			return $this->httpError(404);
		}

		if(!$order->canView()) {
			return $this->httpError(403);
		}

		return $this->customise(new ArrayData(array(
			'Order' => $order
		)))->renderWith('Order_ReceiptEmail');
	}
}