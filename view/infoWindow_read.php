<div id='infoWindowDiv'>
    <table id="timetable">
      <tr>
         <td style="width:105px"><label for="locationName"><strong>Location's name :</strong></label></td>
         <td><input type="text" id="locationName" name="locationName" value="<?php echo $data["name"]; ?>"/></td>
      </tr>
      <tr class="blank_row"></tr>
      <tr>
         <td>Monday</td>
         <td><input id="sliderMonday" type="slider" name="area" value="480;1140" /></td>
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
         <td><input id="sliderThursday" type="slider" name="area" value="480;1140" /></td>
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
   <label><input type='checkbox' onclick="return false;" <?php if($data["free_coffee"]==1) echo "checked='checked'"; ?> /> free internet connection</label><br>
   <label><input type='checkbox' onclick="return false;" <?php if($data["free_connection"]==1) echo "checked='checked'"; ?> /> free coffee</label>
   <br><br>                  
   Rate : 
   <div class='rating'>
      <div class="star-<?php echo ($data["rating"]>=1)?'blue':'dark'; ?>"></div>
      <div class="star-<?php echo ($data["rating"]>=2)?'blue':'dark'; ?>"></div>
      <div class="star-<?php echo ($data["rating"]>=3)?'blue':'dark'; ?>"></div>
      <div class="star-<?php echo ($data["rating"]>=4)?'blue':'dark'; ?>"></div>
      <div class="star-<?php echo ($data["rating"]>=5)?'blue':'dark'; ?>"></div>
   </div>
</div>