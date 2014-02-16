(function($)
{
  var sliders = ["sliderMonday","sliderTuesday","sliderWednesday","sliderThursday","sliderFriday","sliderSaturday","sliderSunday"];


  $.sliders = function() {}

  $.sliders.initSliders=function()
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
      console.log("the object is ");
      console.log(jQuery("#" + slider));
      console.log(jQuery("#" + slider).slider());
      console.log(jQuery("#" + slider).slider( "option", "disabled" ));
      console.log("the object was ");

    }

    return this;
  };

  // We destroy the div containing the sliders.
  $.sliders.destroySliders=function(){
    jQuery("#infoWindowDiv").remove();

    return this;
  };
})(jQuery);