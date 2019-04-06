<?php





function ywboatfetcher(){


	global $ffl_options; 

  //fetch data from yachtworld
  $url = $ffl_options['yw-inventory-feed-url'];
  $xml = simplexml_load_file($url);
  $json = json_encode($xml);
  $data= json_decode($json,true);
  $boats  = $data["VehicleRemarketing"];

  ob_start(); ?>

	<div class="alx-yw-flex-container-row">
	<ul class="list">
		<?php
			foreach ($boats  as $boat) { 	
		?>
				<!-- <div class="alx-yw-flex-col">1</div> -->

		<li class="list-item">
			<div class="list-content">

				<img src="<?php print_r($boat["VehicleRemarketingBoatLineItem"]["ImageAttachmentExtended"][0]["URI"] ) ?>" alt="" />
				<br>
				<h5>
					<?php
						print_r($boat["VehicleRemarketingBoatLineItem"]["VehicleRemarketingBoat"]["ModelYear"]
						.$boat["VehicleRemarketingBoatLineItem"]["VehicleRemarketingBoat"]["MakeString"]
						.$boat["VehicleRemarketingBoatLineItem"]["VehicleRemarketingBoat"]["Model"] )
					?>
				</h5>
				<div class="desc">
					<p>Year: <?php print_r($boat["VehicleRemarketingBoatLineItem"]["VehicleRemarketingBoat"]["ModelYear"]); ?> </p>
					<p>Make: <?php print_r($boat["VehicleRemarketingBoatLineItem"]["VehicleRemarketingBoat"]["MakeString"]); ?> </p>
					<p>Model: <?php print_r($boat["VehicleRemarketingBoatLineItem"]["VehicleRemarketingBoat"]["Model"]); ?> </p>
					
				</div>

				<a href="" class="desc" >Link</a>

			</div>
		</li>
		
		<?php
			}
		?>  

	</ul>
	</div>

 <div>
  <h2>fdf</h3>
 </div>

<?php
echo  ob_get_clean();
}

// $new_post = array(
// 	'post_title' => 'test2',
// 	'post_content' => '$description',
// 	'post_status' => 'draft',
// 	'post_author' => 1,
// 	'post_type' => 'post',
// 	'post_category' => 'yw-boat-list',
	
// 	);
// 	$post_id = wp_insert_post($new_post);




add_shortcode('alx-yw-fetch-boat', 'ywboatfetcher');

function to_footer($content) 
{
  return $content ;
}
add_action('the_content', 'to_footer');





