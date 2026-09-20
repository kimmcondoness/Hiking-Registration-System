
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

  <script src="api.js" defer></script>

  <title>HIKING APP</title>



</head>
<style>
  
        
       .bub {
            width: 130px;
            height: 130px;
            border: 1px solid white;
            box-shadow: inset 5px -5px 10px white;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, .01);
            backdrop-filter: blur(2px);
            position: absolute;
            bottom: -100px;
            /* animation: bubble 3s ease-in infinite; */
        }
        
        .bub::before {
            position: relative;
            content: "";
            background-color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            top: 25px;
            right: 23px;
            box-shadow: 0px 0px 20px white;
        }
        
        .bub.a {
            left: 10%;
            animation: bubble2 2s ease-in 1s infinite;
        }
        
        .bub.b {
            left: 20%;
            animation: bubble 1.5s ease-in 1.4s infinite;
        }
        
        .bub.c {
            left: 28%;
            animation: bubble 5s ease-in 3.8s infinite;
        }
        
        .bub.d {
            left: 40%;
            animation: bubble 1.8s ease-in .5s infinite;
        }
        
        .bub.e {
            left: 75%;
            animation: bubble2 2.3s ease-in 2.5s infinite;
        }
        
        .bub.f {
            left: 90%;
            animation: bubble 2.5s ease-in 3s infinite;
        }
        
        .bub.g {
            left: 60%;
            animation: bubble 2.2s ease-in 2s infinite;
        }
        
        .bub.k {
            left: 50%;
            animation: bubble 1.6s ease-in 2s infinite;
        }
        
        .bub.i {
            left: 65%;
            animation: bubble2 1.8s ease-in 2.1s infinite;
        }
        
        .bub.j {
            left: 3%;
            animation: bubble 2s ease-in 1.5s infinite;
        }
        
        .bub.h {
            left: 35%;
            animation: bubble2 3s ease-in infinite;
        }
        
        @keyframes bubble {
            0% {
                opacity: 0;
            }
            10%,
            93% {
                opacity: 1;
            }
            100% {
                transform: translate(90px, -700px);
                display: none;
            }
        }
        
        @keyframes bubble2 {
            0% {
                opacity: 0;
            }
            10%,
            93% {
                opacity: 1;
            }
            100% {
                transform: translate(-90px, -700px);
                display: none;
            }
        }

    body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    margin: 0;
    font-family: 'Open Sans', sans-serif;
    background: #222;
    background-image:linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.5) 100%), url('https://source.unsplash.com/1600x900/?landscape');
    font-size: 120%;
    overflow-x: hidden;
    
  }
  
  .card {
    
    color: white;
    padding: 2em;
    border-radius: 30px;
    width: 100%;
    max-width: 420px;
    left: 600px;
    position: relative;
    top: 40px;
    box-shadow: 0 15px 25px rgba(16, 3, 254, 0.2);
    backdrop-filter: blur(14px);
    background-color: rgba(0, 0, 0, 0.2);
   
  }
  .card-1 {
    
    color: white;
    padding:2em;
    border-radius: 30px;
    max-width: 420px;
    width: 100%;
    position:relative;
    left: -560px;
    top: 80px;
    box-shadow: 0 15px 25px rgba(32, 2, 116, 0.2);   
    backdrop-filter: blur(14px);
    background-color: rgba(3, 24, 126, 0.2);   
  }


  .search {
  display: flex;
  align-items: center;
  justify-content: center;
}

button {
  margin: 0.5em;
  border-radius: 50%;
  border: none;
  height: 44px;
  width: 44px;
  outline: none;
  background: #7c7c7c2b;
  color: white;
  cursor: pointer;
  transition: 0.2s ease-in-out;
}

input.search-bar {
  border: none;
  outline: none;
  padding: 0.4em 1em;
  border-radius: 24px;
  background: #7c7c7c2b;
  color: white;
  font-family: inherit;
  font-size: 105%;
  width: calc(100% - 100px);
}
button:hover {
  background: #7c7c7c6b;
}
h1.temp {
  margin: 0;
  margin-bottom: 0.4em;
}

.flex {
  display: flex;
  align-items: center;
}
.description {
  text-transform: capitalize;
  margin-left: 8px;
}


  
  
</style>

<body>
    <!-- <div class="container">
        <span class="bub a "></span>
        <span class="bub b "></span>
        <span class="bub c "></span>
        <span class="bub d"></span>
        <span class="bub e"></span>
        <span class="bub f"></span>
        <span class="bub g"></span>
        <span class="bub h"></span>
        <span class="bub i"></span>
        <span class="bub j "></span>
        <span class="bub k"></span>
    </div> -->

  <div class="card">
    <div class="search">
      <input type="text" class="search-bar" placeholder="Search">
      <button><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1.5em"
          width="1.5em" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z">
          </path>
        </svg></button>
    </div>
    <div class="weather loading">
      <h2 class="city">Weather in Tokyo</h2>
      <h1 class="temp">51°C</h1>
      <div class="flex">
        <img src="https://openweathermap.org/img/wn/04n.png" alt="" class="icon" />
        <div class="description">Cloudy</div>
      </div>
      <div class="humidity">Humidity: 60 %</div>
      <div class="wind">Wind speed: 6.2 km/h</div>
      <div class="direction">Wind direction: 36 °</div>
      
      <div class="pressure">Pressure: 50 pa</div>
      <div class="longitude">Longitude: 36 °</div>
      <div class="latitude">Latitude: 67 °</div>
      <div class="buttons">
      <div class="green-button">
        <a href="index.php" class="btn btn-primary">back</a>
      </div>
    </div>
      
    </div>
  </div>
  <div class="card-1">
    <h1>Famous Hiking Spot</h1>
    <ul>
        <li>Bukit Mahkota</li>
        <li>Bukit Broga</li>
        <li>Bukit Fraser</li>
        <li>Bukit Gasing</li>
        <li>Teluk Bahang</li>
        <li>Panorama Hills</li>
        <li>Cameron Highlands</li>
        <li>Gunung Raya</li>
    </ul>
    <h1>Hiking Tips</h1>
    <ul>
        <li>Plan ahead and check the weather</li>
        <li>Stay prepared by bringing the essentials</li>
        <li>Make sure you have the proper amount of food and water</li>
        <li>Choose the right shoe/sock combo</li>
        <li>Always carry a source of light</li>
    </ul>
</div>
</body>

</html>