document.querySelectorAll('.menu-item').forEach(function(menuItem) {
    // Sự kiện mouseenter cho toàn bộ menu-item để hiển thị sub-menu
    menuItem.addEventListener('mouseenter', function() {
        var subMenu = this.querySelector('.sub-menu');
        if (subMenu) {
            subMenu.style.display = 'block'; // Hiển thị sub-menu khi di chuột vào menu-item
        }
    });

    // Sự kiện mouseleave để ẩn sub-menu khi di chuột ra ngoài menu-item và sub-menu
    menuItem.addEventListener('mouseleave', function() {
        var subMenu = this.querySelector('.sub-menu');
        if (subMenu) {
            subMenu.style.display = 'none'; // Ẩn sub-menu khi di chuột ra khỏi menu-item
        }
    });
});

$(document).ready(function(){
	$('#fullscreenBg').slick({
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2500,
        fade: true,
        swipeToSlide: true
    });
});
