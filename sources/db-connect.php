<?php

Class mongoDBConnection
{
	public function getConnection($collections = null)
	{
		$database = 'assignment';

		$connection = new MongoClient('mongodb://assignment:p6831p88@ds031872.mongolab.com:31872/assignment');

		if (isset($collections))
		{
			return $connection = $connection->$database->$collections;
		}
		return $connection;
	}
}
?>
