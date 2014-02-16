<?php
   $locationName= "Le bar de Bretagne";
   $rating=5;
   $freeCoffee=true;

   $id = "unknown id";
   if(isset($_GET['id']))
      $id = $_GET['id'];

   $USER_IS_ADMIN = true;

?>


<div id='infoWindowDiv'>
    <table id="timetable">
      <tr>
         <td style="width:105px"><strong>Location's name :</strong></td>
         <td><input type="text" id="locationName" value='<?php echo $locationName . " (id= " . $id . ")"; ?>' /></td>
      </tr>
      <tr class="blank_row"></tr>
      <tr>
         <td>Monday</td>
         <td><input id="sliderMonday" type="slider" name="area" value="180;1140" /></td>
      </tr>
      <tr>
         <td>Tuesday</td>
         <td><input id="sliderTuesday" type="slider" name="area" value="480;1140" /></td>
      </tr>
      <tr>
         <td>Wednesday</td>
         <td><input id="sliderWednesday" type="slider" name="area" value="480;1140" /></td>
      </tr>
      <tr>
         <td>Thursday</td>
         <td><input id="sliderThursday" type="slider" name="area" value="480;1340" /></td>
      </tr>
      <tr>
         <td>Friday</td>
         <td><input id="sliderFriday" type="slider" name="area" value="480;1140" /></td>
      </tr>
      <tr>
         <td>Saturday</td>
         <td><input id="sliderSaturday" type="slider" name="area" value="480;1140" /></td>
      </tr>
      <tr>
         <td>Sunday</td>
         <td><input id="sliderSunday" type="slider" name="area" value="480;1140" /></td>
      </tr>
   </table>
   <br>
   <label><input type='checkbox' id="freeInternetConnection" /> free internet connection</label><br>
   <label><input type='checkbox' id="freeCoffee" <?php if($freeCoffee==true) echo "checked='checked'"; ?> /> free coffee</label>
   <br><br>                  
   Rate : 
   <div class='rating'>
      <input type='radio' class='rating-input' id='rating-input-1-5' name='rating-input-1' <?php if($rating===5) echo "checked='checked'"; ?>>
         <label for='rating-input-1-5' class='rating-star'></label>
         <input type='radio' class='rating-input' id='rating-input-1-4' name='rating-input-1' <?php if($rating===4) echo "checked='checked'"; ?>>
         <label for='rating-input-1-4' class='rating-star'></label>
         <input type='radio' class='rating-input' id='rating-input-1-3' name='rating-input-1' <?php if($rating===3) echo "checked='checked'"; ?>>
         <label for='rating-input-1-3' class='rating-star'></label>
         <input type='radio' class='rating-input' id='rating-input-1-2' name='rating-input-1' <?php if($rating===2) echo "checked='checked'"; ?>>
         <label for='rating-input-1-2' class='rating-star'></label>
         <input type='radio' class='rating-input' id='rating-input-1-1' name='rating-input-1' <?php if($rating===1) echo "checked='checked'"; ?>>
         <label for='rating-input-1-1' class='rating-star'></label>
   </div>


   <?php 
   if($USER_IS_ADMIN==true){
   ?>

   <br>                
   <a href='javascript:void(0)' id='addLocation' onclick=''>Update this location</a><br/>
   <a href='javascript:void(0)' id='addLocation' onclick='$.ggMapsFunctions.removeMarker( <?php echo $id; ?>)'>Remove this location</a><br/>
   
   <?php 
   }
   ?>

</div>