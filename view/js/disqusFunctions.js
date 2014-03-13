
// PLUGIN disqusFunctions  containing the functions we added to handle our custom actions.

(function($) {
  $.disqusFunctions = function() {}

  // Refresh the disqus section with the new thread id
  $.disqusFunctions.reloadWithMarkerId=function(id) { //alert("Reloading comments with id= "+id);
    DISQUS.reset({
      reload: true,
      config: function () { 
        this.page.identifier = id;
        this.page.url = "http://localhost:8080/home/show";
      }
    });
    
    return this;
  }

})(jQuery);