/**
 * Fix table responsive dont overflow using dropbdon menu
 * https://stackoverflow.com/questions/26018756/bootstrap-button-drop-down-inside-responsive-table-not-visible-because-of-scroll#34211851
 * http://www.liferayui.com/bootstrap-dropdown-hidden-issue-table/
 * @return {[type]} [description]
 */
var dropdownMenu;                                  
$('.responsive-dropdown ').on('show.bs.dropdown', function (e) {
    dropdownMenu = $(e.target).find('.dropdown-menu');
    $('body').append(dropdownMenu.detach());
    var eOffset = $(e.target).offset();
    dropdownMenu.css({
        'display': 'block',
        'top': eOffset.top + $(e.target).outerHeight(),
        'left': eOffset.left -92,
    'width':'184px',
    'font-size':'14px',
    'z-index': 5000
    });
  dropdownMenu.addClass("mobPosDropdown");
 });
    
$('.responsive-dropdown ').on('hide.bs.dropdown', function (e) {
    $(e.target).append(dropdownMenu.detach());
    dropdownMenu.hide();
 });

