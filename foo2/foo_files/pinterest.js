define("views/pinterest",[],function(){"use strict";var e=Backbone.View.extend({initialize:function(){var e=y$('<div class="l-pinterest"></div>');y$('link[rel="image_src"]').each(function(){e.append(y$("<img>").prop("src",this.href))}),window.setTimeout(function(){y$("body").prepend(e)},1)}});return new e});