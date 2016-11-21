<?php include '../../../wp-load.php'; ?>
                    <?php 
			$offer_id = $_GET['cat_id'];
			if($offer_id != '') {
				$sql_locations = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE status = 1 && cat_id=$offer_id "); 
			}else {
				$sql_locations = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE status = 1 "); 
			}

			foreach( $sql_locations as $rs_location ) {
				$offer_description = substr($rs_location->offer_description,0,15);

				$prc_val = ($rs_location->pay_value/$rs_location->retails_value); 
				$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
				$tot_per = 100 - $percent_friendly;
				$tot_per = $tot_per."% OFF";

				$retail_val = $rs_location->retails_value;
				$pay_val = $rs_location->pay_value;

				$lat= $rs_location->latitude; //latitude
				$lng= $rs_location->longitude; //longitude
				$address= getaddress($lat,$lng);

				$markers[] = array(
				"$address",
				$rs_location->latitude,
				$rs_location->longitude,
				"$rs_location->offer_image_path",
				"$offer_description",
				"$tot_per",
				"$retail_val",
				"$pay_val"
				);
			}
					//print_r($markers);
				?>
				<div id="map_wrapper">
				<div id="map_canvas" class="mapping"></div>
			
			<style>

				#map_wrapper {
					height: 300px;
				}

				#map_canvas {
					width: 100%;
					height: 350px;
				}
			.map_ico {
				margin-bottom: 60px;
				max-height: 300px;
			}


			</style>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD84iwE1qE0EPyKXMS8zBj3J_4J1Q9fP3w"></script>

			<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
			  type="text/javascript"></script>-->	
			<script>

				function initialize() {
					var map;
					var bounds = new google.maps.LatLngBounds();
					var mapOptions = {
						scrollwheel: false,
						mapTypeId: "roadmap",
						center: new google.maps.LatLng(52.791331, -1.918728), // somewhere in the uk BEWARE center is required
						zoom: 20,
					};

					// Display a map on the page
					map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
					map.setTilt(45);

					// Multiple Markers
					var markers = <?php echo json_encode( $markers ); ?>;

				// Info Window Content
					var infoWindowContent = [
						['<div class="info_content">' +
						'<h3>London Eye</h3>' +
						'<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' + '</div>'],
						['<div class="info_content">' +
						'<h3>Palace of Westminster</h3>' +
						'<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
						'</div>']
					];

					// Display multiple markers on a map
					var infoWindow = new google.maps.InfoWindow();
					var marker, i;

					// Loop through our array of markers & place each one on the map
					for (i = 0; i < markers.length; i++) {
						var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
						bounds.extend(position);
						marker = new google.maps.Marker({
							position: position,
							map: map,
							title: markers[i][0]  
						});



						// Allow each marker to have an info window
						google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
							return function () {
						var mar_img = markers[i][3];
						var mar_name = markers[i][4];		
						var tot_per = markers[i][5];		
						var retail_val = markers[i][6];
						var pay_val = markers[i][7];
				
						html = '<div class="product-map"><img src="'+mar_img+'" width="110px" height="50px">'+ '<h2>' + mar_name +'</h2><p class="discount">' + tot_per +'</p><p class="retail">$ ' + retail_val +'</p><p class="final">$ ' + pay_val + '</p></div>';

								infoWindow.setContent(html);
								infoWindow.open(map, marker);
							}
						})(marker, i));

					    /*google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
							return function () {
								//infoWindow.setContent(markers[i][0]);
								infoWindow.close();
							}
						})(marker, i));*/

						// Automatically center the map fitting all markers on the screen
						map.fitBounds(bounds);
					}

					//Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
					var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
						this.setZoom(3);
						google.maps.event.removeListener(boundsListener);
					});

				}
				google.maps.event.addDomListener(window, 'load', initialize);


			</script>
                
