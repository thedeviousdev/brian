<?php
require_once "db.php";
require_once "pretty_json.php";

date_default_timezone_set('Australia/Melbourne');

function get_all_users() {

	try {
		$user_sql = "SELECT * FROM testdb.User ORDER BY UserRole ASC;";

		foreach(returnDB()->query($user_sql) as $row) {

			$user_arr[] = array(
				'Username' => $row['Username'],
				'UserRole' => $row['UserRole']
			);
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}

	return $user_arr;
}


function get_user($user) {

	try {
		$user_sql = "SELECT * FROM testdb.User WHERE Username = '" . $user . "';";

		foreach(returnDB()->query($user_sql) as $row) {
			$user_arr[] = array(
				'Username' => $row['Username'],
				'UserRole' => $row['UserRole']
			);
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}

	return $user_arr;
}



function get_all_types() {
	try {
		$user_sql = "SELECT DISTINCT UserRole FROM testdb.User;";

		foreach(returnDB()->query($user_sql) as $row) {

			$user_arr[] = array(
				'UserRole' => $row['UserRole']
			);
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}

	return $user_arr;
}

function set_user_role($username, $role) {

	try {
		$user_sql = "UPDATE testdb.User SET UserRole = '" . $role . "' WHERE Username = '" . $username . "';";

		returnDB()->query($user_sql);

	} catch (Exception $e) {
		return;
	}
	return 1;
}

function set_new_user($username, $password, $email, $role, $location, $firstname, $lastname, $auth) {

	try {
		$user_sql = "INSERT INTO testdb.User (Username, Password, UserRole) VALUES ('" . $username . "', '" . $password . "', '" . $role . "');";
		returnDB()->query($user_sql);


		// Look into this for Offenders later
		if ($role == 'Staff') {
			$staff_sql = "INSERT INTO testdb.Staff (Username, email, FirstName, LastName) VALUES ('" . $username . "', '" . $email . "', '" . $firstname . "', '" . $lastname . "');";
		returnDB()->query($staff_sql);

			$location_sql = "INSERT INTO testdb.StaffLocation (Username, LocationID, StartDate, EndDate) VALUES ('" . $username . "', '" . $location . "', '" . date('Y-m-d h:i:s', time()) . "', NULL);";
			returnDB()->query($location_sql);

			$auth_sql = "INSERT INTO testdb.StaffAuthentication (Username, LocationID, Authenticated) VALUES ('" . $username . "', '" . $location . "', '" . $auth . "');";
			returnDB()->query($auth_sql);
		}

	} catch (Exception $e) {
		return;
	}
	return 1;
}

function set_user_password($username, $password) {

	try {
		$user_sql = "UPDATE testdb.User SET Password = '" . $password . "' WHERE Username = '" . $username . "';";

		returnDB()->query($user_sql);

	} catch (Exception $e) {
		return;
	}
	return 1;
}

function get_user_salt($username) {

	try {
		$user_sql = "SELECT Salt FROM testdb.User WHERE Username = '" . $username . "';";

		foreach(returnDB()->query($user_sql) as $row) {
			return $row['Salt'];
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}
}



// Create JSON encoded object to be served with previous array data
// TODO: Condense all of these outputs
function user_output($arr) {
	$user_obj = array(
		'Users' => $arr
	);
	
	return $user_obj;
}