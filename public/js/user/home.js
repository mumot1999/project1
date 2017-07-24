$( "#newOrderModal #site" ).click(function() {
 var site = $( "#myModal #site option:selected" ).text().toLowerCase();

 $( "#order_form" ).removeClass("hidden");
});

$( '#newOrderModal #url' ).change(function() {

})

$( '#newOrderModal #action' ).change(function() {
  switch($("#newOrderModal #action option:selected").text())
  {
    case 'Like':{
      $("label[for='score_target']").html("Likes:");
      break;
    }

    case 'Follow':{
      $("label[for='score_target']").html("Follows:");
      break;
    }
  }

})

$( '#jobInstagram' ).click( function() {

  var button = $( '#jobInstagram' );

  if (button.html() == "End Job"){
    $.ajax({
          method: 'GET',
          url: urlEndJob,
          data: {_token: token}
      })
      .done(function () {
          button.html("Get New Job");
          location.reload();
    })
  }

  if (button.html() != "End Job"){
    $.ajax({
          method: 'POST',
          url: urlGetJob,
          data: {site: 'Instagram', action: 'Like', _token: token}
      })
      .done(function (msg) {
        if(msg.url)
        {
          button.html("End Job");

          window.open(msg.url, 'Like this photo', 'window settings');

        }

      })
  }
});
