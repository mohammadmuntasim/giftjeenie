<?php

require_once 'giftjeenie.base.class.php';

class Message extends GiftJeenieBase implements JsonSerializable
{
	private $_id;
	private $_message_type;
	private $_message_content;
	private $_message_desc;

	public function __construct()
	{
		$_id = 0;
		$_message_type = 0;
		$_message_content = '';
		$_message_desc = 0;
	}

	public function setID( $id )
	{
		$this->_id = $id;
	}

	public function getID()
	{
		return $this->_id;
	}

	public function setGiftId( $gift_id )
	{
		$this->_gift_id = $gift_id;
	}

	public function getGiftId()
	{
		return $this->_gift_id;
	}

	public function setMessageType( $message_type )
	{
		$this->_message_type = $message_type;
	}

	public function getMessageType()
	{
		return $this->_message_type;
	}

	public function setMessageContent( $message_content )
	{
		$this->_message_content = $message_content;
	}

	public function getMessageContent()
	{
		return $this->_message_content;
	}

	public function setMessageDesc( $message_desc )
	{
		$this->_message_desc = $message_desc;
	}

	public function getMessageDesc()
	{
		return $this->_message_desc;
	}

	public function jsonSerialize()
	{
		return [
			'message_id' => $this->_id,
			'message_type' => $this->_message_type,
			'message_content' => $this->_message_content,
			'message_desc' => $this->_message_desc,
			'meta' => $this->_meta
		];
	}
}