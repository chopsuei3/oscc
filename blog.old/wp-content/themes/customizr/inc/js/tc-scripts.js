jQuery(document).ready(function () {
    ! function (a) {
        function g(a) {
            (a.which > 0 || "mousedown" === a.type || "mousewheel" === a.type) && f.stop().off("scroll mousedown DOMMouseScroll mousewheel keyup", g)
        }

        //fancybox with localized script variables
        var b = TCParams.FancyBoxState,
            c = TCParams.FancyBoxAutoscale;
        1 == b && a("a.grouped_elements").fancybox({
            transitionIn: "elastic",
            transitionOut: "elastic",
            speedIn: 200,
            speedOut: 200,
            overlayShow: !1,
            autoScale: 1 == c ? "true" : "false",
            changeFade: "fast",
            enableEscapeButton: !0
        });

        //Slider with localized script variables
        var d = TCParams.SliderName,
            e = TCParams.SliderDelay;
        0 != d.length && (0 != e.length ? a("#customizr-slider").carousel({
            interval: e
        }) : a("#customizr-slider").carousel());

        //Stop the viewport animation if user interaction is detected
        var f = a("html, body");
        a(".back-to-top").on("click", function (a) {
            f.on("scroll mousedown DOMMouseScroll mousewheel keyup", g), f.animate({
                scrollTop: 0
            }, 1e3, function () {
                f.stop().off("scroll mousedown DOMMouseScroll mousewheel keyup", g)
            }), a.preventDefault()
        }),

        //Detecting browser with CSS
        // Chrome is Webkit, but Webkit is also Safari.
        //alert($.browser.msie);
        a.browser.chrome ? a("body").addClass("chrome") : a.browser.webkit ? a("body").addClass("safari") : a.browser.msie && a("body").addClass("ie"),

        //Detect layout and reorder content divs
        a(window).on("load", function () {
            function i() {
                767 > c && (g && h ? a(d).insertBefore(e) : g ? a(d).insertBefore(e) : a(d).insertBefore(f))
            }

            function j() {
                767 > c ? a("#main-wrapper .container .span3.tc-sidebar").insertAfter(d) : g && h ? a(d).insertBefore(f) : g ? a(d).insertAfter(e) : a(d).insertBefore(f)
            }
            var b = a(window),
                c = b.width(),
                d = a("#main-wrapper .container .article-container"),
                e = a("#main-wrapper .container .span3.left.tc-sidebar"),
                f = a("#main-wrapper .container .span3.right.tc-sidebar"),
                g = !1,
                h = !1;
            e.length > 0 && (g = !0), f.length > 0 && (h = !0);
            var k = new Date(1, 1, 2e3, 12, 0, 0),
                l = !1,
                m = 200;
            a(window).resize(function () {
                k = new Date, l === !1 && (l = !0, setTimeout(j, m))
            }), i(), a(".widget-front, article").hover(function () {
                a(this).addClass("hover")
            }, function () {
                a(this).removeClass("hover")
            }), a(".widget li").hover(function () {
                a(this).addClass("on")
            }, function () {
                a(this).removeClass("on")
            }), a("article.attachment img").delay(500).animate({
                opacity: 1
            }, 700, function () {})
        })
    }(window.jQuery)
});