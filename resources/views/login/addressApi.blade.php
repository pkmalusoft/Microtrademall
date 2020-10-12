 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsX9DdNvSI_KRNHpmqs_im-Hblcpd2-YI&libraries=places"></script>

<script>

  google.maps.event.addDomListener(window, 'load', function () {

      var places = new google.maps.places.Autocomplete(document.getElementById('location'));

      google.maps.event.addListener(places, 'place_changed', function () {

       var place = places.getPlace();

       var lat = place.geometry.location.lat();

       var lng = place.geometry.location.lng();

       $('#lat').val(lat);

       $('#long').val(lng);

      });

  });



  $('#location').keypress(function(e) {

    if (e.which == 13) {

      return false;

    }

  });

  
</script>