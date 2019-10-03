import { checkSidebar } from '../../utils/_helpers';

// console.log('checkSidebar', checkSidebar)

var orientations = ['left', 'right'];
for (let index = 0; index < orientations.length; index++) {
        const orientation = orientations[index];
        checkSidebar(orientation);
        
}

jQuery(document).ready(($) => {
    // Sidebar
    
    

    $('#sidebar-leftCollapse').on('click', function () {
		// $('#sidebar-left').toggleClass('active');
		if($('#sidebar-left').hasClass('active') == false) {
			$('#sidebar-left').addClass('active');
			$('body').removeClass('sidebar-is-opened');
			localStorage.setItem('sidebarLeft', 'close');
		}
		else {
			$('#sidebar-left').removeClass('active');
			$('body').addClass('sidebar-is-opened');
			localStorage.setItem('sidebarLeft', 'open');
		}
	});

	$('#sidebar-rightCollapse').on('click', function () {
		if($('#sidebar-right').hasClass('active') == false) {
			$('#sidebar-right').addClass('active');
			$('body').removeClass('sidebar-is-opened');
			localStorage.setItem('sidebarRight', 'close');
		}
		else {
			$('#sidebar-right').removeClass('active');
			$('body').addClass('sidebar-is-opened');
			localStorage.setItem('sidebarRight', 'open');
		}
	});
})