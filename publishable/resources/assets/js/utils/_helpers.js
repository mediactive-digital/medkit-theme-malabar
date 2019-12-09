// Datatables

    // Set language
    function defineLangDatable() {
        
        if (typeof($.fn.dataTable) !== 'undefined') {

            $.extend(true, $.fn.dataTable.defaults, {
                language: Lang.getDataTable()
            });
        }
    }

    // Format information messages
    function defineInfoDatable() {
        
        if (typeof($.fn.dataTable) !== 'undefined') {

            $.extend(true, $.fn.dataTable.defaults, {
                infoCallback: function(settings, start, end, max, total) {

                    var info = settings.oLanguage.sInfo || '';

                    if (info) {

                        info = info.replace(/_START_/g, numberFormat(start))
                            .replace(/_END_/g, numberFormat(end))
                            .replace(/_MAX_/g,  numberFormat(max))
                            .replace(/_TOTAL_/g, numberFormat(total));
                    }

                    return info;
                }
            });
        }
    }

// Format numbers with locale
function numberFormat(number) {

    var parts = number.toString().split('.');

    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, Lang.getLocale() == 'fr' ? ' ' : '.');
    
    return parts.join(',');
}

// Disable elements
function disableElements(elements, loader) {

    loader = typeof loader !== 'undefined' ? loader : true;

    elements.filter(':focus').blur();

    elements.each(function() {

        $(this).addClass('disabled');

        if ($(this).is('a, area, link, button, input, select, textarea, optgroup, option, fieldset')) {

            $(this).attr('disabled', true);
        }

        if (loader) {

			$(this).html('<i class="fa fa-fw fa-spinner fa-pulse"></i><span class="sr-only loading-text">' + $(this).html() + '</span>');
        }
    });
}

// Enable elements
function enableElements(elements, loader) {

    loader = typeof loader !== 'undefined' ? loader : true;

    elements.each(function() {

        if (loader) {

			$(this).html($(this).find('.loading-text').html());
        }

        if ($(this).is('a, area, link, button, input, select, textarea, optgroup, option, fieldset')) {
            
            $(this).attr('disabled', false);
        }

        $(this).removeClass('disabled');
    });
}
function getSettingsFromLocalStorage(item) {
   var the_item = localStorage.getItem(item);
   if(the_item === null) {
       console.log('item specified  '+ item +' has no key')
   }
   else {
       return the_item;
   }
}
function checkSidebar(orientation) {
    var val_to_check = '';
    var elm = '';
    if(orientation.toLowerCase() === 'left') {
        val_to_check += 'sidebarLeft';
        elm += '#sidebar-left';
    }
    else {
        val_to_check += 'sidebarRight';
        elm += '#sidebar-right';
    }
    var the_setting = getSettingsFromLocalStorage(val_to_check);

    if(the_setting === 'close') {
        $(elm).addClass('active');
        $('body').removeClass('sidebar-is-opened');
    }
    else {
        $(elm).removeClass('active');
        $('body').addClass('sidebar-is-opened');
    }
}

module.exports = {
    checkSidebar,
    enableElements,
    disableElements,
    defineLangDatable,
    defineInfoDatable,
    numberFormat
}
