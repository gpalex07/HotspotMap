(function($)
{
  $.initSliders = function() {}

  $.initSliders.init=function()
  {
    var sliders = ["sliderMonday","sliderTuesday","sliderWednesday","sliderThursday","sliderFriday","sliderSaturday","sliderSunday"];

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
      }})
    }

    return this;
  };
})(jQuery);