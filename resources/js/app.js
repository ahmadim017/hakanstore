require('./bootstrap');

var Turbolinks = require("turbolinks")
Turbolinks.start()

Turbolinks.setProgressBarDelay(1)

$(document).on('turbolinks:load', function (){
  //dropdown menu
  $('.dropdown-toggle').dropdown();

});