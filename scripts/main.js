var BrowserDetect = {
    init: function() {
        this.browser = this.searchString(this.dataBrowser) || "Other", this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown"
    },
    searchString: function(a) {
        for (var e = 0; e < a.length; e++) {
            var i = a[e].string;
            if (this.versionSearchString = a[e].subString, i.indexOf(a[e].subString) !== -1) return a[e].identity
        }
    },
    searchVersion: function(a) {
        var e = a.indexOf(this.versionSearchString);
        if (e !== -1) {
            var i = a.indexOf("rv:");
            return "Trident" === this.versionSearchString && i !== -1 ? parseFloat(a.substring(i + 3)) : parseFloat(a.substring(e + this.versionSearchString.length + 1))
        }
    },
    dataBrowser: [{
        string: navigator.userAgent,
        subString: "Edge",
        identity: "ms-edge"
    }, {
        string: navigator.userAgent,
        subString: "MSIE",
        identity: "explorer"
    }, {
        string: navigator.userAgent,
        subString: "Trident",
        identity: "explorer"
    }, {
        string: navigator.userAgent,
        subString: "Firefox",
        identity: "firefox"
    }, {
        string: navigator.userAgent,
        subString: "Opera",
        identity: "opera"
    }, {
        string: navigator.userAgent,
        subString: "OPR",
        identity: "opera"
    }, {
        string: navigator.userAgent,
        subString: "Chrome",
        identity: "chrome"
    }, {
        string: navigator.userAgent,
        subString: "Safari",
        identity: "safari"
    }]
};
$(function() {
    function a(a, e) {
        a.each(function() {
            var a = $(this),
                i = a.attr("data-os-animation"),
                n = a.attr("data-os-animation-delay");
            a.css({
                "-webkit-animation-delay": n,
                "-moz-animation-delay": n,
                "animation-delay": n
            });
            var s = e ? e : a;
            s.waypoint(function() {
                a.addClass("animated").addClass(i)
            }, {
                triggerOnce: !0,
                offset: "90%"
            })
        })
    }
    a($(".os-animation")), a($(".staggered-animation"), $(".staggered-animation-container"))
}), $(document).ready(function() {
    $(".menuTabLink li a").click(function() {
        $(".menuTabLink li a").removeClass("act"), $(this).addClass("act"), $(".menuTab").removeClass("act");
        var a = $(this).attr("href");
        $(".menuTab" + a).addClass("act")
    }), $(".ban-car").owlCarousel({
        loop: !0,
        nav: !0,
        autoplay: !0,
        autoplayTimeout: 3e3,
        autoplayHoverPause: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: !0,
        smartSpeed: 1500,
        items: 1,
        responsive: {
            0: {
                dots: !0,
                nav: !1
            },
            600: {
                nav: !0
            },
            1e3: {
                nav: !0
            }
        }
    }), $(".car-specialist").owlCarousel({
        loop: !0,
        nav: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: !1,
        items: 1
    }), $(".car-faci").owlCarousel({
        margin: 40,
        loop: !0,
        nav: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: !1,
        items: 2,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1e3: {
                items: 2
            }
        }
    }), $(".car-testi").owlCarousel({
        margin: 40,
        loop: !0,
        nav: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: !1,
        items: 1
    }), $(".car-news").owlCarousel({
        margin: 40,
        loop: !1,
        nav: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: !1,
        items: 3,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1e3: {
                items: 3
            }
        }
    }), $(".car-wards").owlCarousel({
        margin: 40,
        loop: !0,
        nav: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: !0,
        items: 3,
        center: !0,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1e3: {
                items: 3
            }
        }
    }), $(".time-slot").owlCarousel({
        margin: 2,
        loop: !1,
        nav: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: !1,
        items: 7,
        responsive: {
            0: {
                nav: !1,
                items: 3
            },
            600: {
                items: 5
            },
            1e3: {
                items: 7
            }
        }
    }), $(".time-slot ul li.sTime").click(function() {
        $(this).toggleClass("active")
    }), $("#gotoStep2").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600), $(".stepwizard-row").addClass("in-step2"), $(".stepwizard-step.step2").addClass("completed done"), $(".step1-container").hide(), $(".step2-container").show()
    }), $("#gotoStep3").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600), $(".stepwizard-row").addClass("in-step3"), $(".stepwizard-step.step3").addClass("completed done"), $(".step2-container").hide(), $(".step3-container").show()
    }), $(window).width() > 992 && $(".patient-tools a").hover(function() {
        $(this).addClass("active")
    }, function() {
        $(this).removeClass("active")
    }), $(".main-nav li.dropdown").hover(function() {
        $(this).find(".dropdown-menu.hover").stop(!0, !0).delay(100).fadeIn(500)
    }, function() {
        $(this).find(".dropdown-menu.hover").stop(!0, !0).delay(100).fadeOut(500)
    }), $(".date").datepicker({
        format: "mm/dd/yyyy",
        startDate: "-3d",
        autoclose: !0
    }), $(window).scroll(function() {
        $(".menu-box").hide(), $(window).scrollTop() > 30 ? ($(".main-nav").addClass("act animated fadeInDown"), $(".home-banner").addClass("act"), $("body").addClass("sticky"), $(".menu-box").addClass("scrolm")) : ($(".main-nav").removeClass("act animated fadeInDown"), $(".home-banner").removeClass("act"), $("body").removeClass("sticky"), $(".menu-box").removeClass("scrolm"))
    }), $(".panel-group .collapse.in").each(function() {
        $(this).prev("h4").find(".fa").addClass("fa-minus-circle").removeClass("fa-plus-circle")
    }), $(".collapse").on("show.bs.collapse", function() {
        $(this).prev("h4").find(".fa").removeClass("fa-plus-circle").addClass("fa-minus-circle")
    }).on("hide.bs.collapse", function() {
        $(this).prev("h4").find(".fa").removeClass("fa-minus-circle").addClass("fa-plus-circle")
    }), $(".doc-profile-full .panel-group .collapse.in").each(function() {
        $(this).prev("h3").find(".fa").addClass("fa-angle-up").removeClass("fa-angle-down")
    }), $(".doc-profile-full .collapse").on("show.bs.collapse", function() {
        $(this).prev("h3").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-up")
    }).on("hide.bs.collapse", function() {
        $(this).prev("h3").find(".fa").removeClass("fa-angle-up").addClass("fa-angle-down")
    })
}), $(document).on("mouseenter", ".main-nav .nav li.dropdown", function() {
    if ($(window).width() > 768) {
        var a = $(this).children().attr("target");
        a && ($(".main-nav .nav li.dropdown").removeClass("active"), $(this).addClass("active"), $(".menu-box .tabsCont").hide(), $("#" + a).fadeIn(), $(".menu-box").slideDown())
    }
}).on("mouseleave", ".main-nav .nav li", function() {
    console.log("mouseleave")
}), $(".menu-box").mouseleave(function(a) {
    window && $(this).slideUp(), $(".main-nav .nav li.dropdown").removeClass("active")
});