$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });

  $('nav').find('[data-toggle=tab]').click(function (e) {
    var newHash = this.href.match(/[#]{1}[\w]+\b/)[0];

    $('.nav-tabs li.active').removeClass('active');
    $('html,body').scrollTop(0);
    $('[href="' + newHash + '"]').parent('li').addClass('active');
  });
});
