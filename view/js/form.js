(function($)
{
  var sliders = ["sliderMonday","sliderTuesday","sliderWednesday","sliderThursday","sliderFriday","sliderSaturday","sliderSunday"];


  $.form = function() {}

  $.form.initSliders=function()
  {
    for (var i=0; i<sliders.length; i++) {
      var slider = sliders[i];

      jQuery("#" + slider).slider({ 
        from: 0, 
        to: 1440, 
        step: 15, 
        dimension: '', 
        //scale: ['0:00', '4:00', '8:00', '12:00', '16:00', '20:00', '24:00'], 
        limits: false, 
        callback: function(value){
          document.getElementById(slider).value = value; // Update the value (important, otherwise the value of the slider is not in the innerHTML)
        },
        calculate: function( value ){
            var hours = Math.floor( value / 60 );
            var mins = ( value - hours*60 );
            return (hours < 10 ? "0"+hours : hours) + ":" + ( mins == 0 ? "00" : mins );
      }});
    }

    return this;
  };

  // We destroy the div containing the sliders.
  $.form.destroySliders=function(){
    jQuery("#infoWindowDiv").remove();

    return this;
  };


  // Extracts the values in the infowindow (location's name, opening hours ...) and return an object containing these values.
  $.form.extractContentInfoWindow=function(){
    var formValues             = new Object();
    formValues.locationName    =  document.getElementById("locationName").value;

    formValues.sliderMonday    = document.getElementById("sliderMonday"   ).value;
    formValues.sliderTuesday   = document.getElementById("sliderTuesday"  ).value;
    formValues.sliderWednesday = document.getElementById("sliderWednesday").value;
    formValues.sliderThursday  = document.getElementById("sliderThursday" ).value;
    formValues.sliderFriday    = document.getElementById("sliderFriday"   ).value;
    formValues.sliderSaturday  = document.getElementById("sliderSaturday" ).value;
    formValues.sliderSunday    = document.getElementById("sliderSunday"   ).value;


    formValues.freeConnection = document.getElementById("freeInternetConnection").checked;
    formValues.freeCoffee     = document.getElementById("freeCoffee").checked;

    var rating=-1;
    if(document.getElementById("rating-input-1-5").checked==true)      rating=5;
    else if(document.getElementById("rating-input-1-4").checked==true) rating=4;
    else if(document.getElementById("rating-input-1-3").checked==true) rating=3;
    else if(document.getElementById("rating-input-1-2").checked==true) rating=2;
    else if(document.getElementById("rating-input-1-1").checked==true) rating=1;

    formValues.rating= rating;

    return formValues;
  }
  

  $.form.createEncodedStringFromFormObject=function(formValues){
    var params="?";
    params+= "locationName="    +encodeURIComponent(formValues.locationName) +"&";
    params+= "sliderMonday="    +formValues.sliderMonday    +"&";
    params+= "sliderTuesday="   +formValues.sliderTuesday   +"&";
    params+= "sliderWednesday=" +formValues.sliderWednesday +"&";
    params+= "sliderThursday="  +formValues.sliderThursday  +"&";
    params+= "sliderFriday="    +formValues.sliderFriday    +"&";
    params+= "sliderSaturday="  +formValues.sliderSaturday  +"&";
    params+= "sliderSunday="    +formValues.sliderSunday    +"&";
    params+= "freeConnection="  +formValues.freeConnection  +"&";
    params+= "freeCoffee="      +formValues.freeCoffee      +"&";
    params+= "rating="          +formValues.rating          +"&";
    params+= "lat="             +formValues.position.lat()  +"&";
    params+= "lng="             +formValues.position.lng();

    return params;
  }


})(jQuery);