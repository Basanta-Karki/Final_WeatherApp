// Retrieve references to various HTML elements using their respective IDs
const displayCity = document.getElementById("City");
const displayWeathericon = document.getElementById("currentinfo"); 
const displayTemp = document.getElementById("temperature");
const displayPressure = document.getElementById("pressure");
const displayHumidity = document.getElementById("humidity");
const displayWind = document.getElementById("wind-speed");
const displayweatherdescrip = document.getElementById("checkdescription");
const datevar = document.getElementById("date");
const dayvar = document.getElementById("day");

// Prevent the default form submission behavior
document.getElementById("formDiv").addEventListener("submit", (e) => {
    e.preventDefault();
});

// When the window is loaded, call the function displaydefaultweatherinfo()
window.addEventListener("load", displaydefaultweatherinfo);

// This Asynchronous function fetches the weather data of the default city ("redcar") in metric units.
async function displaydefaultweatherinfo() {

    if (window.navigator.onLine) {
        console.log("ONLINE MODE: Storing data to LocalStorage")
        try {
            const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=redcar&units=metric&appid=e02d1cd9b32f99953630a3142806d7e4`);
            const data = await response.json();
    
            // Extract weather information from response data and display it
            displayCity.innerHTML = data.name;
            displayTemp.innerHTML = `${data.main.temp}°C`;
            displayPressure.innerHTML = `${data.main.pressure} hPa`;
            displayHumidity.innerHTML = `${data.main.humidity}%`;
            displayWind.innerHTML = `${data.wind.speed} Km/H`;
            displayweatherdescrip.innerHTML = data.weather[0].description;
            const icon = data.weather[0].icon;
            displayWeathericon.src = `https://openweathermap.org/img/wn/${icon}@2x.png`;
    
            // Getting date info
            var todayDate = data.dt;
            var date = new Date(todayDate * 1000);
            var formattedDate = date.toLocaleString("en-us", {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric",
            });
            datevar.innerHTML = formattedDate;
            // dayvar.innerHTML = formattedTime;
    
            // Store weather data in local storage
            const weatherDataDefault = {
                CityName: data.name,
                Temperature: data.main.temp,
                Pressure: data.main.pressure,
                Humidity: data.main.humidity,
                Wind: data.wind.speed,
                Description: data.weather[0].description,
                WeatherIcon: icon,
                formattedDate: formattedDate
            };
            localStorage.setItem("redcar", JSON.stringify(weatherDataDefault));
    
        } catch (error) {
            console.log(error);
            alert(error);
        }
    }
    if (!window.navigator.onLine) {
        
        console.log("OFFLINE MODE: Getting data from LocalStorage")

        const defaultweather = localStorage.getItem("redcar");

        const weatherData = JSON.parse(defaultweather);
        console.log(weatherData)
        
        displayCity.innerHTML = weatherData.CityName;

        datevar.innerHTML = formattedDate;

        displayTemp.innerHTML = weatherData.Temperature + "°C"

        displayPressure.innerHTML = weatherData.Pressure + "hPa"

        displayweatherdescrip.innerHTML = weatherData.Description;

        displayHumidity.innerHTML = weatherData.Humidity + "%"

        displayWind.innerHTML = weatherData.wind + "Km/H"

        const icons = weatherData.WeatherIcon

        displayWeathericon.src = `https://openweathermap.org/img/wn/${icons}@2x.png`;


    }
    
}

// This Asynchronous function fetches the weather data of user input and displays it in metric units.
async function displayweatherinfo() {

    if (window.navigator.onLine) {
        console.log("ONLINE MODE: Storing data to LocalStorage")

        try {
            const inputCity = document.getElementById("search").value;
            const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${inputCity}&units=metric&appid=e02d1cd9b32f99953630a3142806d7e4`);
            const data = await response.json();
    
            if (data.cod == 404) {
                alert("City not Found !!!");
                return;
            }
    
            // Extract weather information from response data and display it
            displayCity.innerHTML = data.name;
            displayTemp.innerHTML = `${data.main.temp}°C`;
            displayPressure.innerHTML = `${data.main.pressure} hPa`;
            displayHumidity.innerHTML = `${data.main.humidity}%`;
            displayWind.innerHTML = `${data.wind.speed} Km/H`;
            displayweatherdescrip.innerHTML = data.weather[0].description;
            const icon = data.weather[0].icon;
            displayWeathericon.src = `https://openweathermap.org/img/wn/${icon}@2x.png`;
    
            // Getting date info
            var todayDate = data.dt;
            var date = new Date(todayDate * 1000);
            var formattedDate = date.toLocaleString("en-us", {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric",
            });
            datevar.innerHTML = formattedDate;
            // dayvar.innerHTML = formattedTime;
    
            // Store weather data for user input city in local storage
            const weatherDataInput = {
                CityName: data.name,
                Temperature: data.main.temp,
                Pressure: data.main.pressure,
                Humidity: data.main.humidity,
                Wind: data.wind.speed,
                Description: data.weather[0].description,
                WeatherIcon: icon,
                formattedDate: formattedDate
            
            };
            localStorage.setItem(inputCity, JSON.stringify(weatherDataInput));
    
        } catch (error) {
            console.log(error);
            alert(error);
        }

    }

    if (!window.navigator.onLine) {

        try{
            console.log("OFFLINE MODE: Getting data from LocalStorage")

            const inputCity = document.getElementById("search").value;

            const InputcityWeather = localStorage.getItem(inputCity);

            if (InputcityWeather === null) {
                alert("City not Found in local storage !!!");
                return;
            }

            const weatherData = JSON.parse(InputcityWeather);
            console.log(weatherData)

            displayCity.innerHTML = weatherData.CityName;
            
            datevar.innerHTML = weatherData.formattedDate;

            displayTemp.innerHTML = weatherData.Temperature + "°C"

            displayPressure.innerHTML = weatherData.Pressure + "hPa"

            displayweatherdescrip.innerHTML = weatherData.Description;

            displayHumidity.innerHTML = weatherData.Humidity + "%"

            displayWind.innerHTML = weatherData.Wind + "Km/H"

            const icons = weatherData.WeatherIcon

            displayWeathericon.src = `https://openweathermap.org/img/wn/${icons}@2x.png`;


        }catch (error) {
            console.log(error);
            alert(error);
        }
    
        
    }

    
}
