
if (typeof jQuery === "undefined") { throw new Error("CmsTwb3's tab.js requires jQuery"); }

; var CmsTwb3 = {};

;(function($){
	CmsTwb3.Tab = {
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
