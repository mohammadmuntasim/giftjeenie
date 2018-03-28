<?php

require_once 'giftjeenie.base.class.php';

class Product extends GiftJeenieBase implements JsonSerializable
{
	private $_id;
	private $_order;
	private $_name;
	private $_url;
	private $_price;
	private $_currency;
	private $_trend_rating;
	private $_category;
	private $_images;
	private $_source;
	private $_description;

	public function __construct()
	{
		$this->_name  = '';
		$this->_images = array();
		$this->_description = '';
		$this->_price = 0;
		$this->_currency = 'CAD';
		$this->_trend_rating = '0';
		$this->_order = '0';
	}

	public function setName( $name )
	{
		$this->_name = $name;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function setImages( $imagePath )
	{
		$this->_images = $imagePath;
	}

	public function getImages()
	{
		return $this->_images;
	}

	public function setDescription( $description )
	{
		$this->_description = $description;
	}

	public function getDescription()
	{
		return $this->_description;
	}

	public function setPrice( $price )
	{
		$this->_price = $price;
	}

	public function getPrice()
	{
		return $this->_price;
	}

	public function setUrl( $url )
	{
		$this->_url = $url;
	}

	public function getUrl()
	{
		return $this->_url;
	}

	public function setCurrency( $currency )
	{
		$this->_currency = $currency;
	}

	public function getCurrency()
	{
		return $this->_currency;
	}

	public function setSource( $source )
	{
		$this->_source = $source;
	}

	public function getSource()
	{
		return $this->_source;
	}

	public function setCategory( $category )
	{
		$this->_category = $category;
	}

	public function getCategory()
	{
		return $this->_category;
	}

	public function setTrendRating( $trend_rating )
	{
		$this->_trend_rating = $trend_rating;
	}

	public function getTrendRating()
	{
		return $this->_trend_rating;
	}

	public function setID( $id )
	{
		$this->_id = $id;
	}

	public function getID()
	{
		return $this->_id;
	}

	public function setOrder( $order )
	{
		$this->_order = $order;
	}

	public function getOrder()
	{
		return $this->_order;
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->_id,
			'order' => $this->_order,
			'name' => $this->_name,
			'url' => $this->_url,
			'price' => $this->_price,
			'currency' => $this->_currency,
			'trend_rating' => $this->_trend_rating,
			'images' => $this->_images,
			'source' => $this->_source,
			'description' => $this->_description,
			'meta' => $this->_meta,
			'category' => $this->_category,
		];
	}
}