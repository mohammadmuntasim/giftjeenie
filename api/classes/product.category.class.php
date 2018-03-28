<?php

require_once 'giftjeenie.base.class.php';

class ProductCategory extends GiftJeenieBase implements JsonSerializable
{
	private $_id;
	private $_name;

	public function __construct()
	{
		$this->_name  = '';
	}

	public function setID( $id )
	{
		$this->_id = $id;
	}

	public function getID()
	{
		return $this->id;
	}

	public function setName( $name )
	{
		$this->_name = $name;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->_id,
			'name' => $this->_name,
			'meta' => $this->_meta,
		];
	}

}