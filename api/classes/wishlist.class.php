<?php

require_once 'giftjeenie.base.class.php';

class Wishlist extends GiftJeenieBase implements JsonSerializable 
{
	private $_id;
	private $_name;
	private $_user;
    private $_groupstatus;
	private $_details;

	// private $_sharing_info;

	public function __construct()
	{
		$this->_id = 0;
		$this->_name = '';
		$this->_user = null;
		$this->_meta = array();
        $this->_groupstatus = '';
		$this->_details = array();

		// $this->_sharing_info = array();
	}

	public function setStatus( $groupstatus )
	{
		$this->_groupstatus = $groupstatus;
	}

	public function getStatus()
	{
		// return $groupstatus;
		return $this->_groupstatus;
	}

	public function setID( $id )
	{
		$this->_id = $id;
	}

	public function getID()
	{
		return $id;
	}

	public function setName( $name )
	{
		$this->_name = $name;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function setUserId( $user )
	{
		$this->_user = $user;
	}

	public function getUserId()
	{
		return $this->_user;
	}

	public function setDetails( $details )
	{
		$this->_details = $details;
	}

	public function getDetails()
	{
		return $this->_details;
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->_id,
			'name' => $this->_name,
			'groupstatus' => $this->_groupstatus,
			'user' => $this->_user,
			'meta' => $this->_meta,
			'details' => $this->_details,
			//'sharing_info' => $this->_sharing_info,
			'product_name' => ''
		];
	}
}