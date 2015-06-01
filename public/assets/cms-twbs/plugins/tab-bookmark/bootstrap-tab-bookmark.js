/* ========================================================================
 * CmsTwbs: bootstrap-tab-bookmark.js v0.1.0
 * https://github.com/coolms/twbs
 * ========================================================================
 * Copyright 2006-2015 Altgraphic, ALC.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

if (typeof jQuery === "undefined") { throw new Error("bootstrap-tab-bookmark.js plugin requires jQuery"); }

; var CmsTwbs = {};

;(function($){
	CmsTwbs.Tab = {
        bookmark: function(selector)
        {
            if(selector == undefined){
                selector = "";
            }
            /* Automagically jump on good tab based on anchor */
            $(document).ready(function(){
                url = document.location.href.split("#");
                if(url[1] != undefined) {
                    $(selector + "[href=#"+url[1]+"]").tab("show");
                }
            });
            var update_location = function(event){
                document.location.hash = this.getAttribute("href");
            };
            /* Update hash based on tab */
            $(selector+"[data-toggle=pill]").click(update_location);
            $(selector+"[data-toggle=tab]").click(update_location);
        },
    };
})(jQuery);
