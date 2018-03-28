<?php

require_once 'giftjeenie.base.class.php';

class Gift extends GiftJeenieBase implements JsonSerializable 
{
	// echo "Hie";exit;
	private $_id;
	private $_gift_id;
	private $_wishlist_id;
	private $_product_id;
	private $_order_details;
	private $_delivery_details;
	private $_gift_message;
	private $_thank_you_message;

	public function setID( $id )
	{
		$this->_id = $id;
	}

	public function getID()
	{
		return $this->_id;
	}

	public function setGiftID( $id )
	{
		$this->_gift_id = $id;
	}

	public function getGiftID()
	{
		return $this->_gift_id;
	}

	public function setWishlistID( $id )
	{
		$this->_wishlist_id = $id;
	}

	public function getWishlistID()
	{
		return $this->_wishlist_id;
	}

	public function setProductID( $id )
	{
		$this->_product_id = $id;
	}

	public function getProductID()
	{
		return $this->_product_id;
	}

	public function setOrderDetails( $order_details )
	{
		$this->_order_details = $order_details;
	}

	public function getOrderDetails()
	{
		return $this->_order_details;
	}

	public function setDeliveryDetails( $delivery_details )
	{
		$this->_delivery_details = $delivery_details;
	}

	public function getDeliveryDetails()
	{
		return $this->_delivery_details;
	}

	public function setGiftMessage( $gift_message )
	{
		$this->_gift_message = $gift_message;
	}

	public function getGiftMessage()
	{
		return $this->_gift_message;
	}

	public function setThankYouMessage( $thank_you_message )
	{
		$this->_thank_you_message = $thank_you_message;
	}

	public function getThankYouMessage()
	{
		return $this->_thank_you_message;
	}

	public function jsonSerialize()
	{
		return [
			"id" => $this->_id,
			"gift_id" => $this->_gift_id,
			"order_details" => $this->_order_details,
			"delivery_date" => $this->_delivery_details,
			"gift_message_id" => $this->_gift_message,
			"thank_you_message_id" => $this->_thank_you_message,
			"meta" => $this->_meta
		];
	}
}