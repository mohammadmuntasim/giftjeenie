<?php

class GiftJeenieBase
{
	protected $_meta;

	public function __construct()
	{
		$_meta = array();
	}

	public function setMeta( $meta )
	{
		$this->_meta = $meta;
	}

	public function getMeta()
	{
		return $this->_meta;
	}
}