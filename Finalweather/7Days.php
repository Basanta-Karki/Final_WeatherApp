<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7 Days Weather data</title>

    <script>
        function showAlert(message) {
            alert(message);
        }
        
    </script>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        *{
            margin: 0;
            font-family: 'Poppins', sans-serif;
            padding: 0;
            box-sizing: border-box;
        }
        #heading{
            text-align: center;
            padding-top: 25px;
            text-decoration: underline;
        }
        #container{
            background-color: #75C2F6;
            
        }
        h1{
            margin-bottom: 25px;

        }

        #info {
            
            margin-left: 40px;
            width: 100%;
            height: 100%;   
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
                  
        }
        #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{

            margin-top: 20px;
            width: 15%;
            height: 625px;
            padding: 35px 42px;
            border: 2px solid black;
            text-align: center;
            margin-bottom: 7px;
            background-color: #a0d2f4;
            margin-left: 10px;
            margin-right: 10px;
            border: none;
            border-radius: 5px        
        }
        h2, h3{
            padding-bottom: 20px
        }
        button{
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border-radius: 5px;
            font-weight: 600;
            
             
        }
        button:hover{
            background-color: hsl(120, 66%, 16%);
            border: 3px solid white;

        }
        
        #searchbtn{
            text-align: center;
            

        }
        #center-button{
            text-align: center;
            margin-top: 10px;
            padding-bottom: 30px;
        }
        #center-btn{
           
            margin-top: 10px;
            padding-top: 70px;
        }
        #search{
           
            width: 20%;
            margin: 10px 0;
            padding: 10px 20px;
            border: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            
        }
        #btn{
                      
            width: 100px;
            padding: 10px 20px;
            margin-left: 6px;
            font-weight: 600;
            background-color: green;
            color: white;
            border: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border-radius: 5px;
        } 
        #btn:hover{

            background-color: rgb(49, 61, 15);
            color: white;

        }
        #currentweather{
    
            background-color: #75C2F6;
            text-align: center;
            margin-top: 25px;
            height: 100vh;
           
        }
        #display{

            margin-top: 7%;
            width: 38%;
            height: 680px;
            padding: 35px 42px;
            border: 2px solid black;
            text-align: center;
            margin-bottom: 7px;
            background-color: #a0d2f4;
            margin-left: 31%;
            margin-right: 10px;
            border: none;
            border-radius: 5px 
            
        }


        @media(max-width: 1887px){

            #info {
                flex-direction: row;
                align-items: center;
            }
            #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{
                height: 640px;
                width: 20%; 
                margin: 10px;
                margin-left: 50px;
                margin-right: 15px;
                
            }
                   
        }
      

        @media(max-width: 1508px){
            #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{
                width: 26%;    
                margin-left: 50px;
                height: 610px;
              
            }

        }

        @media(max-width: 1396px){
            #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{
                height: 670px; 
                      
                
            }

        }

        @media(max-width: 1069px){
            #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{
                width: 37%;
                margin-left: 50px;
              
            }

        }
        @media(max-width: 920px){
            #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{            
                margin-left: 39px;
              
            }

        }
        @media(max-width: 740px){
            #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{            
                margin-left: 0px;
                width: 45%;
              
            }

        }
        @media(max-width: 559px){
            #Sunday, #Monday, #Tuesday, #Wednesday, #Thursday, #Friday, #Saturday{            
                margin-left: 20px;
                width: 75%;
              
            }

        }
        
    </style>
    
</head>
<body>

<?php

$servername = "localhost";
$database = "Sevendays_Weather";
$username = "root";
$password = "";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $database, $port);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $inputCity = $_POST["city"];
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=${inputCity}&units=metric&appid=e02d1cd9b32f99953630a3142806d7e4";

    $response = file_get_contents($api_url);
    if ($response !== false) {

        $data = json_decode($response, true);

        $weatherIcon = $data["weather"][0]["icon"];
        $Temp = $data["main"]["temp"];
        $Description = $data["weather"][0]["description"];
        $Humidity = $data["main"]["humidity"];
        $Pressure = $data["main"]["pressure"];
        $wind_speed = $data["wind"]["speed"];

        $currentDay = date("l");

        $updateinfo = "UPDATE weather_data SET Temperature='$Temp', Humidity='$Humidity', Pressure='$Pressure', Wind_speed='$wind_speed', Weather_description='$Description', Weather_icon ='$weatherIcon' WHERE Day='$currentDay'";

        if (mysqli_query($conn, $updateinfo)) {

            $sql = "SELECT * FROM weather_data";
            $result = mysqli_query($conn, $sql);

            echo "<div id='currentweather'>";  

            echo "<h1 id='heading'>$inputCity Weather Data</h1>";
            
            echo "<div id='display'>";
        
            echo "<h1>Today's Weather data</h1>";  
            echo "<img src = 'https://openweathermap.org/img/wn/$weatherIcon@2x.png' >";  
            echo "<h2>Temperature: $Temp °C</h2>";  
            echo "<h3>Humidity: $Humidity %</h3>";  
            echo "<h3>Pressure: $Pressure hPa</h3>";  
            echo "<h3>Wind Speed: $wind_speed km/H</h3>";  
            echo "<h2>Weather Description: $Description</h2>";
            
            
            echo "<div id='center-btn'>"; 
            echo "<a href='index.html'><button>Go Back ⇦</button></a>";
            echo "</div>"; 
        
            echo "</div>";
        
            echo "</div>";

            // if (mysqli_query($conn, $sql)){

            //     $Seven_days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday","Friday", "Saturday"]; 
    
            //     while ($row = mysqli_fetch_assoc($result)) {
    
            //         $Name_of_day = $row["Day"];
            //         $Index_of_day = array_search($Name_of_day, $Seven_days);
            //         $Id_of_day = $Seven_days[$Index_of_day];

            //         // Check if the day matches the current day
            //         if ($row['Day'] === $currentDay) {
            //             echo "<div id='$Id_of_day'>";
            //             // Display the weather data for the current day
            //             echo "<h1>".$row['Day']."</h1>";
            //             echo "<img src='https://openweathermap.org/img/wn/".$row['Weather_icon']."@2x.png'>";
            //             echo "<h2>Temperature: ".$row['Temperature']."°C</h2>";
            //             echo "<h3>Humidity: ".$row['Humidity']."%</h3>";
            //             echo "<h3>Pressure: ".$row['Pressure']." hPa</h3>";
            //             echo "<h3>Wind Speed: ".$row['Wind_speed']." km/H</h3>";
            //             echo "<h2>Weather Description: ".$row['Weather_description']."</h2>";
            //             echo "</div>";
            //         }
            //     }
            //     mysqli_free_result($result); 

            // }else {
            //     echo "Error: " . mysqli_error($conn);
            // }

        }
        else {
            echo "Error: " . mysqli_error($conn);
        }

    } else {
        echo "<script>alert('City not found! Please enter a valid city name.');</script>";
    }
   
} else {

    $inputCity = "redcar";
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=$inputCity&units=metric&appid=e02d1cd9b32f99953630a3142806d7e4";
    $response = file_get_contents($api_url);
    $data = json_decode($response, true);
    
    $today = date("Y-m-d");
    $weatherIcon = $data["weather"][0]["icon"];
    $Temp = $data["main"]["temp"];
    $Description = $data["weather"][0]["description"];
    $Humidity = $data["main"]["humidity"];
    $Pressure = $data["main"]["pressure"];
    $wind_speed = $data["wind"]["speed"];

    $currentDay = date("l");

    $updateinfo = "UPDATE weather_data SET Temperature='$Temp', Humidity='$Humidity', Pressure='$Pressure', Wind_speed='$wind_speed', Weather_description='$Description', Weather_icon ='$weatherIcon' WHERE Day='$currentDay'";

    if (mysqli_query($conn, $updateinfo)) {

        $sql = "SELECT * FROM weather_data";
        $result = mysqli_query($conn, $sql);

        echo "<div id='container'>";

        echo "<h1 id='heading'>7 Days Weather Data</h1>";

        echo "<div id='searchbtn'>";

        echo "<form method='POST' action=''>";

        echo "<input id='search' type='text' name='city' placeholder='Enter the City Name...'>";
        echo "<button id='btn' type='submit'>Search</button>";

        echo "</form>";

        echo "</div>";

        echo "<div id='info'>";

        if (mysqli_query($conn, $sql)){

            $Seven_days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday","Friday", "Saturday"]; 

            while ($row = mysqli_fetch_assoc($result)) {

                $Name_of_day = $row["Day"];
                $Index_of_day = array_search($Name_of_day, $Seven_days);
                $Id_of_day = $Seven_days[$Index_of_day];

                echo "<div id='$Id_of_day'>";

                echo "<h1>".$row['Day']."</h1>";

                echo "<img src='https://openweathermap.org/img/wn/".$row['Weather_icon']."@2x.png'>";
                echo "<h2>Temperature: ".$row['Temperature']."°C</h2>";
                echo "<h3>Humidity: ".$row['Humidity']."%</h3>";
                echo "<h3>Pressure: ".$row['Pressure']." hPa</h3>";
                echo "<h3>Wind Speed: ".$row['Wind_speed']." km/H</h3>";
                echo "<h2>Weather Description: ".$row['Weather_description']."</h2>";

                echo "</div>"; 
            
            }
            mysqli_free_result($result);   
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        echo "</div>"; 

        echo "<div id='center-button'>";

        echo "<a href='index.html'><button>Go Back ⇦</button></a>";

        echo "</div>";
        echo "</div>";
        echo "</div>";

        mysqli_close($conn);
        
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    if (!$conn) {
        echo "Sorry we failed to connect: " . mysqli_connect_error();
    }

}


?>
    
</body>
</html>