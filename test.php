<?php

//process_data.php

if(isset($_POST["date"]))
{
	$connect = new PDO("mysql:host=192.168.2.80:3306; dbname=gewaechshaus", "sqluser", "password");

	$data = array();

	if($_POST['date'] != '')
	{
        # returns array with original string slit at ","
        $date = $_POST["date"];
        
        # checks if string elements of array are in date format
        if(strtotime($date))
        {        
            // it's a date
        }
        else
        {
            // it's not a date
            throw Exception;
        }

        $date2 = explode(" ", $date);
        $date2[0] = $date2[0] . " 23:59:59";
		
        $sample_data = array(
			':first_date'		=>	$date,
			':second_date'	    =>	$date2[0]
		);

        $query = "
        SELECT * FROM messungen 
        WHERE time >= :first_date
        AND time < :second_date
        ";


		$statement = $connect->prepare($query);

		$statement->execute($sample_data);

        

		$result = $statement->fetchAll(PDO::FETCH_ASSOC);


        foreach ($result as $row) {
            $data[] = $row;
        }
	}
    
	echo json_encode($data);
}

?>