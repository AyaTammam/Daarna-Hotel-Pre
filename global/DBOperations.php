<?php
	session_start();
	require 'en.php';
	$dsn = 'mysql:host=localhost;dbname=hotel';
	$user ='root';
	$pass = '';
	$option = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	);
	try {
		$con = new PDO($dsn, $user, $pass, $option);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

  // Check If User Coming From HTTP Post Request
  if (isset($_POST['LogIn'])) 
  {
    if (isset($_POST['UserName']) && isset($_POST['Password'])) 
    {
      $employee = $con->prepare('SELECT * FROM employees WHERE UserName = ? AND Pass = ?');
      $employee->execute(array($_POST['UserName'], SHA1($_POST['Password'])));
      // If Count > 0 This Mean The Database Contain Record About This User
      if ($employee->rowCount() > 0)
      {
        $user = $employee->fetch();
        if ($user['Job'] == 'Admin')
        {
          $_SESSION['AdminId'] = $user['EmpId'];
          $_SESSION['Admin'] = $user['UserName'];
          echo 'admin';
        }
        else 
        {
          $_SESSION['ReceptionId'] = $user['EmpId'];
          $_SESSION['Reception'] = $user['UserName'];
          echo 'reception';
        }
      }
      else 
      {
        $client = $con->prepare('SELECT * FROM clients WHERE UserName = ? AND Pass = ?');
        $client->execute(array($_POST['UserName'], SHA1($_POST['Password'])));
        if ($client->rowCount() > 0)
        {
          $user = $client->fetch();
          $_SESSION['ClientId'] = $user['ClientId'];
          $_SESSION['Client'] = $user['UserName'];
          echo 'client';
        }
        else 
        {
          ?>
          <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
            <svg class="ErrorLogIn mx-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
              <?php echo $lang['Sorry:ThereIsAnErrorInTheUserNameOrPassword']; ?>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
        }
      }
    }
		else 
		{
			echo http_response_code(501);
		}
  }

	/**
	 * Show All Floors
	 */
	if (isset($_POST['ShowFloor'])) 
	{
		$floorDisplay = $con->prepare('SELECT floors.FloorId, COUNT(flats.FlatId) AS FlatCount, employees.UserName FROM employees JOIN floors ON floors.AdminId = employees.EmpId LEFT JOIN flats ON floors.FloorId = flats.FloorId GROUP BY floors.FloorId');
		$floorDisplay->execute();
		if ($floorDisplay->rowCount() > 0) 
		{
			$Data = $floorDisplay->fetchAll();
			foreach ($Data as $Array)
			{
				?>
				<tr class="FloorsId">
					<td><?php echo $Array['FloorId']; ?></td>
					<td><?php echo $Array['FlatCount']; ?></td>
					<td><?php echo $Array['UserName']; ?></td>
					<td>
						<a href="?Page=Flats&Id=<?php echo $Array['FloorId']; ?>" class="text-info" aria-label="<?php echo $lang['Show']; ?>" data-balloon-pos="left">
              <i class="far fa-eye fs-5"></i>
						</a>
					</td>
				</tr>
				<?php
			}
		}
		else 
		{
			?>
			<tr class="noFloor FloorsId"><td class="text-center" colspan="4"><?php echo $lang['ThereAreNoFloorsToDisplay']; ?></td></tr>
			<?php
		}
	}

	/**
	 * Add New Floor
	 */
	if (isset($_POST['AddFloor'])) 
	{
		if(isset($_POST['FloorId']))
		{
			$_POST['FloorId'] = !is_numeric($_POST['FloorId']) ? 0 : $_POST['FloorId'];
      $InsertFloor = $con->prepare('INSERT INTO floors SET FloorId = ?, AdminId = ?');
      $InsertFloor->execute(array( $_POST['FloorId'] + 1, $_SESSION['AdminId']));
		}
		else 
		{
			echo http_response_code(501);
		}
	}

	/**
	 * Remove Last Floor Service
	 */
	if (isset($_POST['RemoveFloor'])) 
	{
		if(isset($_POST['FloorId']))
		{
			$DeleteFloor = $con->prepare('DELETE FROM floors WHERE FloorId = ?');
			$DeleteFloor->execute(array($_POST['FloorId']));
		}
		else 
		{
			echo http_response_code(501);
		}
	}

  /**
   * Show All Flat
   */

	/**
	 * Add New Flat
	 */
	if (isset($_POST['AddFlat']))
	{
		if (isset($_POST['FlatId']) && isset($_POST['Area']) && isset($_POST['View']) && isset($_FILES['MainImage']) && isset($_FILES['OtherImage'])) 
		{
			print_r($_FILES['MainImage']);
		}
		else 
		{
			echo http_response_code(501);
		}
	}

  /**
   * Remove Flat
   */
  if (isset($_POST['RemoveFlat'])) 
  {
    # code...
  }

  /**
	 * Check If There Were Features for Hotel
	 */
	if (isset($_POST['CheckFeature'])) 
	{
		$GetHotelFeature = $con->prepare("SELECT COUNT(features.FeatureId) - COUNT(hotel_features.FeatureId) AS Count FROM features LEFT JOIN hotel_features ON features.FeatureId = hotel_features.FeatureId WHERE features.Type = 'Primary'");
    $GetHotelFeature->execute();
    $Count = $GetHotelFeature->fetchColumn();
    echo $Count > 0 ? false : true;
	}

  /**
   * Show All Feature
   */
  if (isset($_POST['ShowFeature'])) 
  {
    $FeatureDisplay = $con->prepare('SELECT hotel_features.*, features.FeatureName, employees.UserName FROM employees JOIN hotel_features ON hotel_features.AdminId = employees.EmpId JOIN features ON hotel_features.FeatureId = features.FeatureId');
		$FeatureDisplay->execute();
		if ($FeatureDisplay->rowCount() > 0) 
		{
			echo json_encode($FeatureDisplay->fetchAll());
		}
		else 
		{
			echo json_encode(array());
		}
  }

  /**
   * Add New Feature
   */
  if (isset($_POST['AddFeature'])) 
  {
    if (isset($_POST['FeatureName']) && isset($_POST['Price']) && isset($_POST['Details'])) 
    {
      $CheckIfExsist = $con->prepare("SELECT * FROM hotel_features WHERE FeatureId = ? AND Details = ?");
      $CheckIfExsist->execute(array($_POST['FeatureName'], $_POST['Details']));
      if($CheckIfExsist->rowCount() > 0)
      {
        echo false;
      }
      else 
      {
        $InsertHotelFeature = $con->prepare("INSERT INTO hotel_features SET FeatureId = ?, Details = ?, Price = ?, AdminId = ?");
        $InsertHotelFeature->execute(array($_POST['FeatureName'], $_POST['Details'], $_POST['Price'], $_SESSION['AdminId']));
        echo true;
      }
    }
    else
    {
      echo http_response_code(501);
    }
  }

  /**
   * Edit Feature
   */
  if (isset($_POST['EditFeature'])) 
  {
    if (isset($_POST['Id']) && isset($_POST['FeatureId']) && isset($_POST['Price']) && isset($_POST['Details'])) 
    {
      $CheckIfExsist = $con->prepare("SELECT * FROM hotel_features WHERE FeatureId = ? AND Details = ? AND Id != ?");
      $CheckIfExsist->execute(array($_POST['FeatureId'], $_POST['Details'], $_POST['Id']));
      if($CheckIfExsist->rowCount() > 0)
      {
        echo false;
      }
      else 
      {
        $InsertHotelFeature = $con->prepare("UPDATE hotel_features SET FeatureId = ?, Details = ?, Price = ? WHERE Id = ?");
        $InsertHotelFeature->execute(array($_POST['FeatureId'], $_POST['Details'], $_POST['Price'], $_POST['Id']));
        echo true;
      }
    }
    else
    {
      echo http_response_code(501);
    }
  }

  /**
   * Remove Feature
   */
  if (isset($_POST['RemoveFeature'])) 
  {
    if (isset($_POST['Id'])) 
    {
      $CheckIfWasUesd = $con->prepare(("SELECT * FROM flat_features WHERE FeatureId = ?"));
      $CheckIfWasUesd->execute(array($_POST['Id']));
      if ($CheckIfWasUesd->rowCount() > 0)
      {
        echo false;
      }
      else
      {
        $RemoveFeature = $con->prepare(("DELETE FROM hotel_features WHERE Id = ?"));
        $RemoveFeature->execute(array($_POST['Id']));
        echo true;
      }
    }
    else
    {
      echo http_response_code(501);
    }
  }

  /**
   * Show All Employees
   */
  if (isset($_POST['ShowEmployees'])) 
  {
    $EmployeesDisplay = $con->prepare('SELECT Reception.UserName, Reception.EmpId, employees.UserName AS AddedBy FROM employees AS Reception, employees WHERE Reception.AdminId = employees.EmpId and Reception.Job = "Reception"');
		$EmployeesDisplay->execute();
		if ($EmployeesDisplay->rowCount() > 0) 
		{
			echo json_encode($EmployeesDisplay->fetchAll());
		}
		else 
		{
			echo json_encode(array());
		}
  }

  /**
   * Add New Employees
   */
  if (isset($_POST['AddEmployees'])) 
  {
    if(isset($_POST['UserName']) && isset($_POST['Password']))
		{
      $CheckUserName = $con->prepare("SELECT * FROM employees WHERE UserName = ?");
      $CheckUserName->execute(array($_POST['UserName']));
      if ($CheckUserName->rowCount() == 0)
      {
        $InsertEmployee = $con->prepare('INSERT INTO employees SET UserName = ?, Pass = ?, AdminId = ?');
        $InsertEmployee->execute(array( $_POST['UserName'], SHA1($_POST['Password']), $_SESSION['AdminId']));
        echo true;
      }
      else 
      {
        echo false;
      }
		}
		else 
		{
			echo http_response_code(501);
		}
  }

  /**
   * Edit Employees
   */
  if (isset($_POST['EditEmployees'])) 
  {
    if(isset($_POST['EmpId']) && isset($_POST['UserName']) && isset($_POST['Password']))
		{
      $CheckUserName = $con->prepare("SELECT * FROM employees WHERE UserName = ? AND EmpId != ?");
      $CheckUserName->execute(array($_POST['UserName'], $_POST['EmpId']));
      if ($CheckUserName->rowCount() == 0)
      {
        if (!empty($_POST['Password'])) 
        {
          $Query = 'UPDATE employees SET UserName = ?, Pass = ? WHERE EmpId = ?';
          $Data = array($_POST['UserName'], SHA1($_POST['Password']), $_POST['EmpId']);
        }
        else
        {
          $Query = 'UPDATE employees SET UserName = ? WHERE EmpId = ?';
          $Data = array($_POST['UserName'], $_POST['EmpId']);
        }
        $InsertEmployee = $con->prepare($Query);
        $InsertEmployee->execute($Data);
        echo true;
      }
      else 
      {
        echo false;
      }
		}
		else 
		{
			echo http_response_code(501);
		}
  }
  
	/*
	** Function To Count Number Of Items Rows
	** $item = The Item To Count
	** $table = The Table To Choose From
  ** $where = The Condietion Of The SQL query
	*/
	function countItems($item, $table, $where = '')
	{
		global $con;
		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table $where");
		$stmt2->execute();
		return $stmt2->fetchColumn();
	}