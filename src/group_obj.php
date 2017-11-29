<?php
require_once "db.php";
require_once "pretty_json.php";


// Get all groups
function get_all_groups() {

	try {
		$group_sql = "SELECT * FROM testdb.Group;";

		foreach(returnDB()->query($group_sql) as $row) {

			$group_arr[] = array(
				'GroupID' => $row['GroupID'],
				'GroupName' => $row['GroupName'],
				'GroupAuthor' => $row['GroupAuthor'],
				'GroupType' => $row['GroupType'],
				'DateCreated' => $row['DateCreated'],
				'LastUpdatedAuthor' => $row['LastUpdatedAuthor'],
				'LastUpdated' => $row['LastUpdated'],
				'Archived' => $row['Archived'],
				'ArchiveDate' => $row['ArchiveDate'],
				'Archivist' => $row['Archivist'],
			);
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}

	return $group_arr;
}

// Get specific group
function get_group($id) {

	try {
		$group_sql = "SELECT * FROM testdb.Group WHERE GroupID = '" . $id "';";

		foreach(returnDB()->query($group_sql) as $row) {

			$group_arr[] = array(
				'GroupID' => $row['GroupID'],
				'GroupName' => $row['GroupName'],
				'GroupAuthor' => $row['GroupAuthor'],
				'GroupType' => $row['GroupType'],
				'DateCreated' => $row['DateCreated'],
				'LastUpdatedAuthor' => $row['LastUpdatedAuthor'],
				'LastUpdated' => $row['LastUpdated'],
				'Archived' => $row['Archived'],
				'ArchiveDate' => $row['ArchiveDate'],
				'Archivist' => $row['Archivist'],
			);
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}

	return $group_arr;
}

// Get groups of a specific type
function get_group_of_type($type) {

	try {
		$group_sql = "SELECT * FROM testdb.Group WHERE GroupType = '" . $type "';";

		foreach(returnDB()->query($group_sql) as $row) {

			$group_arr[] = array(
				'GroupID' => $row['GroupID'],
				'GroupName' => $row['GroupName'],
				'GroupAuthor' => $row['GroupAuthor'],
				'DateCreated' => $row['DateCreated'],
				'LastUpdatedAuthor' => $row['LastUpdatedAuthor'],
				'LastUpdated' => $row['LastUpdated'],
				'Archived' => $row['Archived'],
				'ArchiveDate' => $row['ArchiveDate'],
				'Archivist' => $row['Archivist'],
			);
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}

	return $group_arr;
}

// Get groups made by a staff member
function get_staff_groups($author) {

	try {
		$group_sql = "SELECT * FROM testdb.Group WHERE GroupAuthor = '" . $author "' AND Archived IS NULL;";

		foreach(returnDB()->query($group_sql) as $row) {

			$group_arr[] = array(
				'GroupID' => $row['GroupID'],
				'GroupName' => $row['GroupName'],
				'GroupType' => $row['GroupType'],
				'DateCreated' => $row['DateCreated'],
				'LastUpdatedAuthor' => $row['LastUpdatedAuthor'],
				'LastUpdated' => $row['LastUpdated']
			);
		}

	} catch (Exception $e) {
	    echo "Database Error!";
	}

	return $group_arr;
}


// Create JSON encoded object to be served with previous array data
// TODO: Condense all of these outputs
function client_output($arr) {
	$client_obj = array(
		'Clients' => $arr
	);
	
	return $client_obj;
}