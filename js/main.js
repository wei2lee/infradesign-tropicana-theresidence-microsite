function localizeDataSrc(datasrc) {
    if (i18n.lng().indexOf('en') == 0) {
        return 'images/' + datasrc;
    } else {
        return 'images/' + i18n.lng() + '/' + datasrc;
    }
}

function localizeAssetSrc(datasrc) {
    if (i18n.lng().indexOf('en') == 0) {
        return 'assets/' + datasrc;
    } else {
        return 'assets/' + i18n.lng() + '/' + datasrc;
    }
}


$(document).ready(function () {
    //    bouncefix.add('body');

    //console.log($.fn.niceScroll);
    //    if ($.fn.niceScroll) {
    ////        $("html,body").niceScroll();
    //    }
    /* fancy box */

    if (i18n != undefined) {

        $('a.translate-en').data('lang', 'en');
        $('a.translate-zh').data('lang', 'zh');


        $('[data-i18n-src]').each(function () {
            var src = $(this).attr('src');
            if (src.indexOf('images/') == 0) {
                src = src.substring(7);
                $(this).data('data-src', src);
            }
        });
        $('[data-i18n-href]').each(function () {
            var src = $(this).attr('href');
            if (src.indexOf('images/') == 0) {
                src = src.substring(7);
                $(this).data('data-href', src);
            }
        });
        $('[data-i18n-asset-href]').each(function () {
            var src = $(this).attr('href');
            if (src.indexOf('assets/') == 0) {
                src = src.substring(7);
                $(this).data('data-href', src);
            }
        });


        function updateLang(t) {
            $('[data-i18n]').i18n();
            $('[data-i18n-src]').each(function () {
                var datasrc = $(this).data('data-src');
                if (datasrc) {
                    if (i18n.lng().indexOf('en') == 0) {
                        $(this).attr('src', localizeDataSrc(datasrc));
                    } else {
                        $(this).attr('src', localizeDataSrc(datasrc));
                    }
                }
            });
            $('[data-i18n-href]').each(function () {
                var datasrc = $(this).data('data-href');
                if (datasrc) {
                    if (i18n.lng().indexOf('en') == 0) {
                        $(this).attr('href', localizeDataSrc(datasrc));
                    } else {
                        $(this).attr('href', localizeDataSrc(datasrc));
                    }
                }
            });
            $('[data-i18n-value]').each(function () {
                $(this).attr('value', t($(this).attr('data-i18n-value')));
            });
            $('[data-i18n-asset-href]').each(function () {
                var datasrc = $(this).data('data-href');
                if (datasrc) {
                    if (i18n.lng().indexOf('en') == 0) {
                        $(this).attr('href', localizeAssetSrc(datasrc));
                    } else {
                        $(this).attr('href', localizeAssetSrc(datasrc));
                    }
                }
            });


            $('a.translate-en, a.translate-zh').each(function () {
                if ($(this).data('lang') == i18n.lng()) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        };


        $('a.translate-en').click(function () {
            i18n.setLng('en', updateLang);
        });

        $('a.translate-zh').click(function () {
            i18n.setLng('zh', updateLang);
        });

        i18n.init(function (t) {
            updateLang(t);
        });

    }

    if ($('.fancybox').length) {
        if (!$.fn.fancybox) {
            alert('fancybox init failed! developer properly forget to include necessary .js');
        }
        $('.fancybox').fancybox();
    }

    if ($('footer').length) {
        $ct = $('footer');
        $ct.find('.arrow-container a').on('click touchend', function () {
            $('body,html').animate({
                scrollTop: 0
            }, '500');
        });
    }


    if ($('#landing').length) {
        $ct = $('#landing');

        var enddate = new Date(2015, 2, 21, 0, 0, 0, 0);

        $dd = $ct.find('.timer .timer-dd .number');
        $hh = $ct.find('.timer .timer-hh .number');
        $mi = $ct.find('.timer .timer-mi .number');
        $ss = $ct.find('.timer .timer-ss .number');

        function updateTime() {
            var seconds = (enddate.getTime() - new Date().getTime()) / 1000;
            var dd = seconds <= 0 ? 0 : Math.floor(seconds / 86400);
            var hh = seconds <= 0 ? 0 : Math.floor(seconds / 3600) % 24;
            var mi = seconds <= 0 ? 0 : Math.floor(seconds / 60) % 60;
            var ss = seconds <= 0 ? 0 : Math.floor(seconds) % 60;

            $dd.html(sprintf("%02d", dd));
            $hh.html(sprintf("%02d", hh));
            $mi.html(sprintf("%02d", mi));
            $ss.html(sprintf("%02d", ss));
        }

        var countDownId = setInterval(function () {
            updateTime();
        }, 500);

        updateTime();
    }

    if ($('#calculator').length) {
        $('#calculator [type=submit]').click(function () {
            $.fancybox.close();
            parent.$.fancybox.close();
        });
    }



    if ($('#plans').length) {
        //////plans.html set floorplan
        function Floorplan(name, name2) {
            this.i = -1;
            this.name = name;
            this.name2 = name2;
            this.$btn = $('#' + name);
            this.$btn.data('floorplan', this);
            this.datasrc = 'plans/' + name + '.png';
            this.ondatasrc = 'plans/' + name + '-on.png';
            this.thumbdatasrc = 'plans/' + name2 + '.png';
            this.enlargedatasrc = 'plans/' + name2 + '_.png';
            return this;
        }

        var floorplans = [
        new Floorplan('A', 'J'),
        new Floorplan('B', 'M'),
        new Floorplan('C', 'N'),
        new Floorplan('D', 'O'),
        new Floorplan('E', 'P'),
        new Floorplan('F', 'Q'),
        new Floorplan('G', 'R'),
        new Floorplan('H', 'S'),
        new Floorplan('I', 'T')
    ];
        $.each(floorplans, function (i) {
            this.i = i;
        });

        var _planFloorplan = -1;

        function setPlanFloorplan(i) {
            if (i < 0) i = floorplans.length - 1;
            i %= floorplans.length;

            if (i == _planFloorplan) return;
            _planFloorplan = i;

            $.each(floorplans, function (ind) {
                if (_planFloorplan == ind) {
                    this.$btn.data('data-src', this.ondatasrc).attr('src', localizeDataSrc(this.ondatasrc));
                    $('#iA, #iB').data('data-src', this.enlargedatasrc).attr('href', localizeDataSrc(this.enlargedatasrc));
                    $('#ABC').data('data-src', this.thumbdatasrc).attr('src', localizeDataSrc(this.thumbdatasrc));
                } else {
                    this.$btn.data('data-src', this.datasrc).attr('src', localizeDataSrc(this.datasrc));
                }
            });
        }
        $.each(floorplans, function () {
            this.$btn.click(function () {
                setPlanFloorplan($(this).data('floorplan').i);
            });
        });
        $('#L').click(function () {
            setPlanFloorplan(_planFloorplan - 1);
        });
        $('#R').click(function () {
            setPlanFloorplan(_planFloorplan + 1);
        });

        setPlanFloorplan(0);
        //////end - plans.html set floorplan 


        $('#ABC').click(function () {
            doc = document;
            win = doc.defaultView || doc.parentWindow;
            result = 0;
            if ("pageYOffset" in win)
                result = win.pageYOffset;
            else
                result = (jQuery.support.boxModel && document.documentElement.scrollTop) || document.body.scrollTop;
            $(".fancybox").fancybox({
                margin: [result, 1, 1, 1] // top, right, bottom, left
            });
        });
    }


    if ($('#aboutmalaysia').length) {
        $('#btn-downloaddocuments').hover(function () {
            $(this).find('.btn-downloaddocuments-dropdown').slideDown('fast');
        }, function () {
            $(this).find('.btn-downloaddocuments-dropdown').slideUp('fast');
        });
        $(this).find('.btn-downloaddocuments-dropdown').slideUp(0);
    }


});

$(function () {
    $('#img1').click(function () {
        //doc = document;
        //win = doc.defaultView || doc.parentWindow;
        //result = 0;
        //if  ("pageYOffset" in win)
        //    result = win.pageYOffset;
        //else
        //    result = (jQuery.support.boxModel && document.documentElement.scrollTop) || document.body.scrollTop;
        $(".fancybox").fancybox({
            //margin: [result, 1, 1, 1],
            helpers: {
                overlay: {
                    locked: false
                }
            },
            beforeShow: function () {
                $(".fancybox-skin").css("backgroundColor", "#000000");
            }
        });
    });
    $('#img3').click(function () {
        //doc = document;
        //win = doc.defaultView || doc.parentWindow;
        //result = 0;
        //if  ("pageYOffset" in win)
        //    result = win.pageYOffset;
        //else
        //    result = (jQuery.support.boxModel && document.documentElement.scrollTop) || document.body.scrollTop;
        $(".fancybox").fancybox({
            helpers: {
                overlay: {
                    locked: false
                }
            },
            //    margin: [result, 1, 1, 1],
            beforeShow: function () {
                $(".fancybox-skin").css("backgroundColor", "#000000");
            }
        });
    });
    $('#img2').click(function () {
        doc = document;
        win = doc.defaultView || doc.parentWindow;
        result = 0;
        if ("pageYOffset" in win)
            result = win.pageYOffset;
        else
            result = (jQuery.support.boxModel && document.documentElement.scrollTop) || document.body.scrollTop;
        $(".fancybox").fancybox({
            margin: [result, 1, 1, 1],
            beforeShow: function () {
                $(".fancybox-skin").css("backgroundColor", "#FFFFFF");
            }
        });
    });
    $('#img4').click(function () {
        doc = document;
        win = doc.defaultView || doc.parentWindow;
        result = 0;
        if ("pageYOffset" in win)
            result = win.pageYOffset;
        else
            result = (jQuery.support.boxModel && document.documentElement.scrollTop) || document.body.scrollTop;
        $(".fancybox").fancybox({
            margin: [result, 1, 1, 1],
            beforeShow: function () {
                $(".fancybox-skin").css("backgroundColor", "#FFFFFF");
            }
        });
    });
});