import { checkSidebar } from '../../utils/_helpers';

console.log('checkSidebar', checkSidebar)

jQuery(document).ready(($) => {
    // Sidebar
    var orientations = ['left'];
    for (let index = 0; index < orientations.length; index++) {
        const orientation = orientations[index];
        checkSidebar(orientation);
        
    }
    

    $('#sidebar-leftCollapse').on('click', function () {
		$('#sidebar-left').toggleClass('active');
		if($('#sidebar-left').hasClass('active') == false) {
			localStorage.setItem('sidebarLeft', 'close');
		}
		else {
			localStorage.setItem('sidebarLeft', 'open');
		}
	});

	$('#sidebar-rightCollapse').on('click', function () {
		$('#sidebar-right').toggleClass('active');
		if($('#sidebar-right').hasClass('active') == false) {
			localStorage.setItem('sidebarRight', 'close');
		}
		else {
			localStorage.setItem('sidebarRight', 'open');
		}
	});
})