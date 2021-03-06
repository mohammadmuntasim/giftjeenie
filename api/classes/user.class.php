<?php

/**
 * A class to represent a user.
 *
 *
 * @author Ajitem Sahasrabuddhe <asahasrabuddhe@torinit.com>
 * @package GiftJeenie
 * @subpackage User
 * @since 1.0
 */

class User implements JsonSerializable
{
	private $_id;
	private $_first_name;
	private $_last_name;
	private $_gender; 			//modified on 10 Feb
	private $_email;
	private $_role;
	private $_source;
	private $_source_id;
	private $_profile_picture;
	private $_status;
	private $_location;
	private $_last_login_date;
	private $_last_modified_on;
	private $_last_logout;
	private $_created_on;
	private $_dob;
	private $_category = array(); // modified on 10 Feb

	public $address, $apt_suite, $zip_code, $city, $state, $country;

	public function __construct( $first_name, $last_name, $gender, $email, $source, $source_id, $profile_picture )
	{
		$this->_first_name	=	$first_name;
		$this->_last_name	=	$last_name;
		$this->_gender		=	$gender;
		$this->_email		=	$email;
		$this->_source 		= 	$source;
		$this->_source_id 	= 	$source_id;
		$this->_profile_picture = $profile_picture;
		$this->_status = 1;
		$this->_role = 4;
		$this->_location = '';
	}

	public function getFirstName()
	{
		return $this->_first_name;
	}

	public function getLastName()
	{
		return $this->_last_name;
	}

	// modified on 10 Feb
	public function getGender()
	{
		return $this->_gender;
	}

	// modified on 10 Feb
	public function setGender( $gender )
	{
		$this->_gender = $gender;
	}

	public function setID( $id )
	{
		$this->_id = $id;
	}

	public function getID()
	{
		return $this->_id;
	}

	public function getEmail()
	{
		return $this->_email;
	}

	public function setRole( $role )
	{
		$this->_role = $role;
	}

	public function getRole()
	{
		return $this->_role;
	}

	public function getSource()
	{
		return $this->_source;
	}

	public function getSourceId()
	{
		return $this->_source_id;
	}

	public function getProfilePicture()
	{
		return $this->_profile_picture;
	}

	public function setStatus( $status )
	{
		$this->_status = $status;
	}

	public function getStatus()
	{
		return $this->_status;
	}

	public function setLocation( $location )
	{
		$this->_location = $location;
	}
	
	public function getLocation()
	{
		return $this->_location;
	}

	public function setCreatedOn( $created_on )
	{
		$this->_created_on = $created_on;
	}

	public function getCreatedOn()
	{
		return $this->_created_on;
	}

	public function setLastLoginDate( $last_login_date )
	{
		$this->_last_login_date = $last_login_date;
	}

	public function getLastLoginDate()
	{
		return $this->_last_login_date;
	}

	public function setLastModifiedOn( $last_modified_on )
	{
		$this->_last_modified_on = $last_modified_on;
	}

	public function getLastModifiedOn()
	{
		return $this->_last_modified_on;
	}

	public function setLastLogout( $last_logout )
	{
		$this->_last_logout = $last_logout;
	}

	public function getLastLogout()
	{
		return $this->_last_logout;
	}

	// modified on 10 Feb
	public function setCategory( $category = null)
	{
		$this->_category = $category;
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->_id,
			'first_name' => $this->_first_name,
			'last_name' => $this->_last_name,
			'gender' => $this->_gender,
			'email' => $this->_email,
			'status' => $this->_status,
			'role' => $this->_role,
			'profile_picture' => $this->_profile_picture,
			'date_of_birth' => $this->_dob,
			'phone' => $this->_phone,
			'created_on' => $this->_created_on,
			'location' => $this->_location,
			'last_login_date' => $this->_last_login_date,
			'last_modified_on' => $this->_last_modified_on,
			'source' => $this->_source,
			'source_id' => $this->_source_id,
			'last_logout' => $this->_last_logout,
			'address' => [
				'address' => $this->address,
				'apt_suite' => $this->apt_suite,
				'zip_code' => $this->zip_code,
				'city' => $this->city,
				'state' => $this->state,
				'country' => $this->country
			],
			'categories' => $this->_category	//modified on 10 Feb
		];
	}

	public function setDob( $dob )
	{
		$this->_dob = $dob;
	}

	public function getDob()
	{
		return $this->_dob;
	}

	public function setPhone( $phone )
	{
		$this->_phone = $phone;
	}

	public function getPhone()
	{
		return $this->_phone;
	}
}