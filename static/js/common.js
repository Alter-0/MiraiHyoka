$(function(){
  // core initialize
  anikore.suggest.setElement($('#headerSearchInput'));
  anikore.commonSearch.setElement($('#animeSearchHeaderForm'));
  anikore.suggest.setElement($('#footerSearchInput'));
  anikore.commonSearch.setElement($('#animeSearchFooterForm'));

  $('.l-header_searchIcon').click(function(){
    $('.l-header_searchBox').toggle();
  });
  $('.l-header_menuIcon').click(function(){
    $('.m-loginMenu').toggle();
  });
  $('.m-loginMenu_close').click(function(){
    $('.m-loginMenu').toggle();
  });
});

