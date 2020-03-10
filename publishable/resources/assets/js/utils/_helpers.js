(function(global, factory) {

    if (typeof define === "function" && define.amd) {

        define([], factory);
    }
    else if (typeof exports === "object") {

        module.exports = factory();
    }
    else {

        global.Helpers = factory();
    }

})(this, function() {

    var Helpers = function() {};

    // Datatables

        // Set language
        Helpers.prototype.defineLangDatable = function() {
            
            if (typeof($.fn.dataTable) !== 'undefined') {

                $.extend(true, $.fn.dataTable.defaults, {
                    language: Lang.getDataTable()
                });
            }
        };

        // Format information messages
        Helpers.prototype.defineInfoDatable = function() {
            
            if (typeof($.fn.dataTable) !== 'undefined') {

                var _this = this;

                $.extend(true, $.fn.dataTable.defaults, {
                    infoCallback: function(settings, start, end, max, total) {

                        var info = settings.oLanguage.sInfo || '';

                        if (info) {

                            start = start > end ? end : start;

                            info = info.replace(/_START_/g, _this.numberFormat(start))
                                .replace(/_END_/g, _this.numberFormat(end))
                                .replace(/_MAX_/g,  _this.numberFormat(max))
                                .replace(/_TOTAL_/g, _this.numberFormat(total));
                        }

                        return info;
                    }
                });
            }
        };

    // Format numbers with locale
    Helpers.prototype.numberFormat = function(number) {

        var parts = number.toString().split('.');

        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, Lang.getLocale() == 'fr' ? ' ' : '.');
        
        return parts.join(',');
    };

    // AJAX
    Helpers.prototype.ajaxSetup = function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    };

    // Disable elements
    Helpers.prototype.disableElements = function(elements, loader) {

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
    };

    // Enable elements
    Helpers.prototype.enableElements = function(elements, loader) {

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
    };

    Helpers.prototype.getSettingsFromLocalStorage = function(item) {

       var the_item = localStorage.getItem(item);

       if (the_item === null) {

           // console.log('item specified ' + item + ' has no key');
       }
       else {

           return the_item;
       }
    };

    Helpers.prototype.checkSidebar = function(orientation) {

        var val_to_check = '';
        var elm = '';

        if (orientation.toLowerCase() === 'left') {

            val_to_check += 'sidebarLeft';
            elm += '#sidebar-left';
        }
        else {

            val_to_check += 'sidebarRight';
            elm += '#sidebar-right';
        }

        var the_setting = this.getSettingsFromLocalStorage(val_to_check);

        if (the_setting === 'close') {

            $(elm).addClass('active');
            $('body').removeClass('sidebar-is-opened');
        }
        else {

            $(elm).removeClass('active');
            $('body').addClass('sidebar-is-opened');
        }
    };

    var HelpersObject = new Helpers;

    return HelpersObject;
});
