/*http://www.learningjquery.com/2007/03/accordion-madness*/
$(document).ready(function() {
  $('div.accordion> div').hide();  
  $('div.accordion> h3').click(function() {
    var $nextDiv = $(this).next();
    var $visibleSiblings = $nextDiv.siblings('div:visible');
 
    if ($visibleSiblings.length ) {
      $visibleSiblings.slideUp('fast', function() {
        $nextDiv.slideToggle('fast');
      });
    } else {
       $nextDiv.slideToggle('fast');
    }
  });
});