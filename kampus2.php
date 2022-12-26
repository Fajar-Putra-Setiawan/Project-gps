<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // If the user is not logged in, redirect them to the login page
  header('location: login.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
	
	<title>Penginapan Terdekat dari UPN Kampus 2</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

	
</head>
<body>
    <div id="pesan" class="bg-gray-800">
        <div>
            <div class="text-white">
                <div class="flex p-2  bg-gray-800">
                    <div class="flex py-3 px-2 items-center">
                        <p class="text-2xl text-green-500 font-semibold">IN-UP</p> <p class="ml-2 font-semibold italic">
                        DASHBOARD</p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="">
                        <img class="hidden h-24 w-24 rounded-full sm:block object-cover mr-2 border-4 border-green-400"
                            src="https://divedigital.id/wp-content/uploads/2021/10/1-min.png" alt="">
                        <p class="font-bold text-base  text-gray-400 pt-2 text-center w-24">Hello</p>
                    </div>
                </div>
                <div>
                    <ul class="mt-6 leading-10">
                        <li class="relative px-2 py-1 ">
                            <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500" 
                                href="index.php">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="ml-4">DASHBOARD</span>
                            </a>
                        </li>
                        <li class="relative px-2 py-1" x-data="{ Open : false  }">
                            <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
                                x-on:click="Open = !Open">
                                <span
                                    class="inline-flex items-center  text-sm font-semibold text-white hover:text-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                                    </svg>
                                    <span class="ml-4">ITEM</span>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
                                    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
                                    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <div x-show.transition="Open" style="display:none;">
                                <ul x-transition:enter="transition-all ease-in-out duration-300"
                                    x-transition:enter-start="opacity-25 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-xl"
                                    x-transition:leave="transition-all ease-in-out duration-300"
                                    x-transition:leave-start="opacity-100 max-h-xl"
                                    x-transition:leave-end="opacity-0 max-h-0"
                                    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium  rounded-md shadow-inner  bg-green-400"
                                    aria-label="submenu">

                                    <li class="px-2 py-1 text-white transition-colors duration-150">
                                        <div class="px-1 hover:text-gray-800 hover:bg-gray-100 rounded-md">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </svg>
                                                <a href="kampus1.php"
                                                    class="w-full ml-2  text-sm font-semibold text-white hover:text-gray-800">Kampus
                                                    1</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="px-2 py-1 text-white transition-colors duration-150">
                                        <div class="px-1 hover:text-gray-800 hover:bg-gray-100 rounded-md">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </svg>
                                                <a href="#"
                                                    class="w-full ml-2  text-sm font-semibold text-white hover:text-gray-800">Kampus
                                                    2</a>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                        <li class="relative px-2 py-1 ">
                            <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500" 
                                href="logout.php">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="ml-4">LOGOUT</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


<div id="map"></div>
<div id="map" style="width: 100%; height: 100%;"></div>
<script>

	const map = L.map('map').setView([-7.7822926,110.4140138], 15);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
   
    const marker6 = L.marker([ -7.7753995,110.4154613]).addTo(map)
		.bindPopup('<b>Puri Phunix Guest House</b><br />penginapan').openPopup();

    const marker5 = L.marker([-7.7751416,110.4158333]).addTo(map)
		.bindPopup('<b>Ceria Boutique Hotel</b><br />penginapan').openPopup();

    const marker4 = L.marker([-7.7860122,110.4169035]).addTo(map)
		.bindPopup('<b>Habibi Homestay syariah</b><br />penginapan').openPopup();

    const marker3 = L.marker([-7.7852556,110.4172704]).addTo(map)
		.bindPopup('<b>Esvania Homestay</b><br />penginapan').openPopup();

    const marker2 = L.marker([-7.7812887,110.4159491]).addTo(map)
		.bindPopup('<b>Maple Tree Homestay</b><br />penginapan').openPopup();

    const marker = L.marker([-7.7822926,110.4140138]).addTo(map)
		.bindPopup('<b>UPN "Veteran" Yogyakarta Kampus 2 Babarsari').openPopup();


	const popup = L.popup();

	map.on('click',function(e){
		console.log(e)
        var secondMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);

        L.Routing.control({
            waypoints:[
                L.latLng(-7.7822926,110.4140138),
                L.latLng(e.latlng.lat, e.latlng.lng)
            ]
        }).addTo(map);
	})

</script>



</body>
</html>
