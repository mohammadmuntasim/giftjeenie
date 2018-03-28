<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_oa2 extends CI_Controller
{
    public function session($provider_name)
    {
        $this->load->library('session');
        $this->load->helper('url_helper');

        $this->load->library('oauth2/OAuth2');
		$this->load->model('Users_model');
		$this->load->config('oauth2', TRUE);

        $provider = $this->oauth2->provider($provider_name, array(
            'id' => $this->config->item($provider_name.'_id', 'oauth2'),
            'secret' => $this->config->item($provider_name.'_secret', 'oauth2'),
        ));


        if ( ! $this->input->get('code'))
        {
            // By sending no options it'll come back here
            $provider->authorize();
        }
        else
        {
            // Howzit?
            try
            {
                //$token = $provider->access($_GET['code']);
                $token = $provider->access($this->input->get('code'));

                $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.

                if( !isset( $user['email'] ) )
                {
                    //redirect to registration form, pre fill first and last name
                    $data['first_name'] = $user['first_name'];
                    $data['last_name'] = $user['last_name'];

                    $this->view->load( 'wishlist/register' , $data );
                }

                if( $provider_name == 'facebook')
                {
                    $source = 6;
                }
                else
                {
                    $source = 7;
                }

                $new_member_insert_data = array(
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],         
                    'password' => $user['first_name'] . '_' . $user['uid'],
                    'source' => $source,
                    'profile_picture' => '',
                    'created_on'=>date('Y-m-d H:i:s')
                );

                $response = $this->Users_model->create_member($new_member_insert_data); 

                if( isset( $response ) && $response->message_code == 104 ) // User with same email exists
                {
                    // log in the user
                    $email = $user['email'];
                    $password = $response->password; 
                    //$password =$user['first_name'] . '_' . $user['uid'];
//echo $email;echo "<br>";echo $response->message_code;
//echo $password;
                    $result = $this->Users_model->validateExisting($email, $password);
                    //$result = $this->Users_model->validate($email, $password);
                    
                    if( isset( $result->message_code ) && $result->message_code == 153 )
                    {
                        
                        $user_id = $result->id;
                        $token = $result->token;

                        $auth = base64_encode( $user_id . ':' . $token );

                        $this->session->set_userdata( array( 'auth' => $auth, 'user_id'=>$user_id, 'is_logged_in' => true ) );
redirect('wishlist/shared_wishlist');
                        //redirect('wishlist/login');
                    }
                    else // incorrect username or password
                    {
                        //echo $result->message_code;die;
                        $data['message_error'] = TRUE;
                        $this->load->view('frontend/login', $data);
                    }
                }

            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }


	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

}

/* End of file auth_oa2.php */
/* Location: ./application/controllers/auth_oa2.php */