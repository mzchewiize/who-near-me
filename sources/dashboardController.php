<?php
@session_start();

require_once('db-connect.php');

	Class dashBoardController extends mongoDBConnection
	{
		public function loginWithFacebook($id, $email)
		{
			$connection = new mongoDBConnection();
			$db = $connection->getConnection('users');

			$result = $db->findOne(array(
				'id' => $id));

			if ($result)
			{
				$_SESSION['email'] = $result['email'];
				$_SESSION['id'] = $result['id'];

				echo json_encode($_SESSION);
			}
			else
			{
				$result = $db->insert(array(
					'id' => $id,
					'email'	=> $email));

					$_SESSION['email'] = $email;
					$_SESSION['id'] = $id;

				echo json_encode($_SESSION);
			}
		}

		public function updateTweet($id, $placeName, $lat, $lng)
		{
			$connection = new mongoDBConnection();
			$db = $connection->getConnection('users');

			$search = array(
					'placeName' => $placeName,
					'lat' => $lat,
					'lng' => $lng);

			$place = $db->findOne(
				array('place' => array('$elemMatch' => array('placeName' => $placeName))));

			if(empty($place))
			{
				$result = $db->update(
					array(
						'id' => $id
						),
					array(
						'$push' =>
						array(
							'place' => $search)
						) ,
					array(
						'upsert' => true));

			}
			if($result)
			{
				$output['status'] = 200;
				$output['description'] = 'completed';
			}
			echo json_encode($result);

		}

		public function getRecentlySearch($id)
		{
			$connection = new mongoDBConnection();
			$db = $connection->getConnection('users');

			$result = $db->findOne(array(
				'id' => $id));
			return $result['place'];
		}
	}

	switch ($_GET['action'])
	{
		case 'loginWithFacebook':
			$dashBoard = new dashBoardController();
			$dashBoard->loginWithFacebook($_POST['id'], $_POST['email']);
		break;
		case 'updateTweet':
			$dashBoard = new dashBoardController();
			$dashBoard->updateTweet($_POST['id'], $_POST['placeName'], $_POST['lat'], $_POST['lng']);
		break;
	}

?>
