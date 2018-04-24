var seoPlanShortCode = seoPlanShortCode || {},
    seoplanData = seoplanData || {};

( function ( $ )
{
    'use strict';
    var body = $('body');
    var $window = $(window);
    // blog gallery images carousel
    $('.post-format-images-carousel .slides').owlCarousel(
    {
        singleItem:true,
        pagination : false,
        autoPlay: true,
        stopOnHover: true,
        navigation : true,
        navigationText : ['<i class="fa fa-long-arrow-left" aria-hidden="true"></i>','<i class="fa fa-long-arrow-right" aria-hidden="true"></i>']
    });

    imagesCarousel();
    imagesGallery();
    displayCharts();
    caseStudiesFilter();
    caseStudiesCarousel();
    testimonialCarousel();
    postsCarousel();
    showSearchForm();
    likeCaseStudy();
    showVideoPopup();
    countResults();
    toggleMobileNav();
    toogleFooterWidgets();
    stickyHeader();
    toggleFAQ();

    function toggleFAQ() {
        body.find( 'h4', '.seoplan-faq' ).on( 'click', function (e) {
            e.preventDefault();
            var $parent = $( this ).parent(),
                $toogleContent = $( this ).siblings();
            if ( ! $parent.hasClass( 'active' ) )
            {
                $toogleContent.stop( true, true ).slideDown( function () {
                    $parent.addClass( 'active' );
                } );
            }
            else
            {
                $parent.removeClass( 'active' );
                $toogleContent.stop( true, true ).slideUp();
            }
        } );
    }

    function stickyHeader() {

        if (! body.hasClass('sticky-header') ) {
            return;
        }

        var lastScrollTop = 0;
        $window.on('scroll', function () {
            if ( $window.width() > 640) {

                var scrollTop = $(this).scrollTop();

                if ( scrollTop > lastScrollTop)
                {
                    if ( ! body.hasClass( 'top-panel-slide-down' ) )
                    {
                        body.find( '.top-panel', '.site-header' ).slideUp( function () {
                            body.addClass( 'top-panel-slide-down' );
                        } );
                    }
                }
                else
                {
                    if ( body.hasClass( 'top-panel-slide-down' ) )
                    {
                        body.find( '.top-panel', '.site-header' ).slideDown( function () {
                            body.removeClass( 'top-panel-slide-down' );
                        } );
                    }
                }

                lastScrollTop = scrollTop;

            }
        });

        $window.on('resize', function () {
            if ( $window.width() < 768) {
                var $header = body.find( '.site-header' ),
                    wHeight = $header.height();
                $('#seoplan-header-minimized').height(wHeight);
            } else {
                $('#seoplan-header-minimized').removeAttr('style');
            }


        }).trigger('resize');

    }

    function toogleFooterWidgets() {
        body.on( 'click', '.footer-widgets .widget-title', function ( e ) {
            if ( $window.width() > 767 )
            {
                return;
            }
            e.preventDefault();
            var $current = $( this ),
                $parent = $current.parent( '.widget' );
            if ( $parent.hasClass( 'open' ) )
            {
                $current.siblings().stop( true, true ).slideUp( function () {
                    $parent.removeClass( 'open' );
                } );
            }
            else
            {
                $current.siblings().stop( true, true ).slideDown( function () {
                    $parent.addClass( 'open' );
                } );
            }
        } );
    }

    function toggleMobileNav() {
        body.on( 'click', '.toggle-nav', function ( e ) {
            e.preventDefault();
            if ( ! body.hasClass('mobile-nav-shown') )
            {
                body.addClass('mobile-nav-shown');
            }
        } ).on( 'click', '#close-menu, .side-menu-background', function ( e ) {
            e.preventDefault();
            if ( body.hasClass('mobile-nav-shown') )
            {
                body.removeClass('mobile-nav-shown');
            }
        } );
        $( '#menu-mobile-menu .menu-item-has-children > a' ).on( 'click', function ( e )
        {
            e.preventDefault();
            e.stopPropagation();
            var $current = $( this );

            if( ! $current.parent().hasClass( 'expanded' ) )
            {
                $current.siblings( '.sub-menu' ).stop( true, true ).slideDown( 500, function ()
                {
                    $current.parent().addClass( 'expanded' );
                } );
            }
            else
            {
                $current.siblings( '.sub-menu' ).stop( true, true ).slideUp( 500, function ()
                {
                    $current.parent().removeClass( 'expanded' );
                } );
            };
        } );
    }

    function countResults()
    {
        if ( seoPlanShortCode.length === 0 || typeof seoPlanShortCode.countResult === 'undefined' )
        {
            return;
        }
        $.each( seoPlanShortCode.countResult, function ( id )
        {
            var element = $( '#' + id );
            element.counterUp({
                time: 2000
            });
        });
    }

    function showVideoPopup() {
        var id = seoPlanShortCode.VideoBanner;
        var video = $( '#' + id);
        if ( ! video.length )
        {
            return;
        }
        $( '#' + id ).magnificPopup({type:'iframe'});
    }

    function likeCaseStudy() {
        body.on( 'click', '.course-add-to-wishlist', function (e)
        {
            e.preventDefault();
            var current = $(this);
            var data = {
                'action': 'add_case_study',
                'cid': $(this).data('cid')
            };
            if ( ! current.hasClass( 'added' ) )
            {
                current.addClass( 'adding' );

                jQuery.post( seoplanData.ajaxurl, data, function ( response )
                {
                    if ( 'successful' === response.type )
                    {
                        current.removeClass( 'adding' ).addClass( 'added' );
                    }
                }, 'json' );
            }
        } );
    }
    /**
     * Function display search form popup
     */
    function showSearchForm() {
        body.on( 'click', '.label-icon i', function ( e )
        {
            e.preventDefault();
            body.find( '.seoplan-popup-search' ).fadeIn().addClass('open');
        } )
        .on( 'click', '.close-search-popup', function ( e )
        {
            e.preventDefault();
            body.find( '.seoplan-popup-search' ).fadeOut().removeClass('open');
        } );
    }
    /**
     * Posts Carousel function
     */
    function postsCarousel()
    {
        if ( seoPlanShortCode.length === 0 || typeof seoPlanShortCode.postsCarousel === 'undefined' )
        {
            return;
        }
        $.each( seoPlanShortCode.postsCarousel, function ( id, postsCarousel )
        {
            var autoplay = postsCarousel.autoplay ? 4000 : false,
                hidePagination = postsCarousel.navigation,
                itemsSmall = 1;

            if( seoPlanShortCode.number > 1 )
            {
                itemsSmall = seoPlanShortCode.number - 1;
            }

            $( document.getElementById( id ) ).find( '.blog-list' ).owlCarousel({
                items: postsCarousel.number,
                slideSpeed : 800 ,
                pagination: hidePagination,
                autoPlay: autoplay,
                paginationSpeed : 1000,
                itemsDesktopSmall: [979, itemsSmall],
                itemsDesktop: [1199, seoPlanShortCode.number]
            });

        } );
    }

    // Case studies carousel
    function caseStudiesCarousel()
    {
        if ( seoPlanShortCode.length === 0 || typeof seoPlanShortCode.CSCourousel === 'undefined' )
        {
            return;
        }
        $.each( seoPlanShortCode.CSCourousel, function ( id, caseStudiesCarousel )
        {

            var autoplay = caseStudiesCarousel.autoplay ? 4000 : false,
                hidePagination = caseStudiesCarousel.navigation,
                itemsSmall = 1;

            if( caseStudiesCarousel.number > 1 )
            {
                itemsSmall = caseStudiesCarousel.number - 1;
            }

            $( document.getElementById( id ) ).find( '.case-study-items' ).owlCarousel(
                {
                    direction: '',
                    items: caseStudiesCarousel.number,
                    slideSpeed : 800 ,
                    pagination : hidePagination,
                    autoPlay: autoplay,
                    paginationSpeed : 1000,
                    itemsDesktopSmall: [979, itemsSmall],
                    itemsDesktop: [1199, caseStudiesCarousel.number]
                });

        } );
    }

    // Case studies carousel
    function testimonialCarousel()
    {
        if ( seoPlanShortCode.length === 0 || typeof seoPlanShortCode.TCourousel === 'undefined' )
        {
            return;
        }
        $.each( seoPlanShortCode.TCourousel, function ( id, testimonialCarousel )
        {

            var autoplay = testimonialCarousel.autoplay ? 4000 : false,
                hidePagination = testimonialCarousel.navigation;
            if ( 'two_cols' === testimonialCarousel.layout )
            {
                $( document.getElementById( id ) ).find( '.testimonials' ).owlCarousel(
                    {
                        direction: '',
                        items: testimonialCarousel.number,
                        slideSpeed : 800 ,
                        pagination : hidePagination,
                        autoPlay: autoplay,
                        paginationSpeed : 1000,
                        itemsCustom : [
                            [0, 1],
                            [479, 1],
                            [639, 1],
                            [767, 2],
                            [991, 2],
                            [1199, 2]
                        ]
                    }
                );
            }
            else
            {
                $( document.getElementById( id ) ).find( '.testimonials' ).owlCarousel(
                    {
                        direction: '',
                        items: testimonialCarousel.number,
                        slideSpeed : 800 ,
                        pagination : hidePagination,
                        autoPlay: autoplay,
                        paginationSpeed : 1000,
                        itemsCustom : [
                            [0, 1],
                            [479, 1],
                            [639, 1],
                            [767, 1],
                            [991, 1],
                            [1199, 1]
                        ]
                    }
                );
            }
        } );
    }

    /**
     * Image Gallery function
     */
    function imagesGallery()
    {
        if ( seoPlanShortCode.length === 0 || typeof seoPlanShortCode.imagesGallery === 'undefined' )
        {
            return;
        }
        $.each( seoPlanShortCode.imagesGallery, function ( id, imagesGallery )
        {
            var autoplay = imagesGallery.autoplay ? 4000 : false,
                hideNagination = imagesGallery.hideNavigation;

            if ( 'gallery' == imagesGallery.layout )
            {
                $( document.getElementById( id ) ).find( '.carousel-wrapper' ).owlCarousel({
                    autoPlay: autoplay,
                    items : 1,
                    singleItem: true,
                    responsive: true,
                    stopOnHover: true,
                    pagination: false,
                    navigation : hideNagination,
                    navigationText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>']

                });
            }

        } );
    }

    /**
     * Image Carousel function
     */
    function imagesCarousel()
    {
        if ( seoPlanShortCode.length === 0 || typeof seoPlanShortCode.imagesCarousel === 'undefined' )
        {
            return;
        }
        $.each( seoPlanShortCode.imagesCarousel, function ( id, imagesCarousel )
        {
            var autoplay = imagesCarousel.autoplay ? 4000 : false,
                hidePagination = imagesCarousel.pagination;

            if ( 'single' == imagesCarousel.layout )
            {
                $( document.getElementById( id ) ).find( '.carousel-wrapper' ).owlCarousel({
                    autoPlay: autoplay,
                    items : 1,
                    singleItem: true,
                    responsive: true,
                    stopOnHover: true,
                    pagination : hidePagination,
                    paginationSpeed: 300
                });
            }
            else if ( 'list' == imagesCarousel.layout )
            {
                $( document.getElementById( id ) ).find( '.carousel-wrapper' ).owlCarousel({
                    direction: '',
                    items: testimonialCarousel.number,
                    slideSpeed : 800 ,
                    pagination : hidePagination,
                    autoPlay: autoplay,
                    paginationSpeed : 1000,
                    itemsCustom : [
                        [0, 1],
                        [479, 2],
                        [639, 2],
                        [767, 3],
                        [991, 4],
                        [1199, 6]
                    ]
                });
            }

        } );
    }

    /**
     * Chart element
     */
    function displayCharts()
    {
        if ( seoPlanShortCode.length === 0 || typeof seoPlanShortCode.Charts === 'undefined' )
        {
            return;
        }
        $.each( seoPlanShortCode.Charts, function ( id,chartData )
        {
            var config = {
                type: 'doughnut',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        backgroundColor: chartData.backgroundColor,
                        hoverBackgroundColor: chartData.hoverBackgroundColor
                    }],
                    borderWidth: [55,55,55,55,55]
                },
                options: {
                    responsive: true,
                    legend: false,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            };
            var chartObj = document.getElementById(id);
            if ( chartObj !== null )
            {
                var ctx = chartObj.getContext('2d');
                window.myDoughnut = new Chart(ctx, config);
            }
        } );
    }

    // Case studies filtering
    function caseStudiesFilter()
    {
        var cSFilterOption = $( '.case-study-filter' );
        var cSFilter = $( '.seoplan-list-case-studies' ).find( '.case-studies-list' ).isotope({
            // options
        });
        cSFilterOption.on( 'click', function ( e )
        {
            e.preventDefault();
            var current = $( this );
            var filterData = current.data('filter');
            // toogle active class
            cSFilterOption.removeClass( 'active' );
            current.addClass( 'active' );
            cSFilter.isotope({ filter: filterData });

        } );
    }

    var backgroundEffect = body.find('.animation-bg');
    var fadeInBottom =  body.find('.animation-bottom');
    var fadeInTop =  body.find('.animation-top');
    var fadeInLeft =  body.find('.animation-left');
    var fadeInRight =  body.find('.animation-right');

    function check_if_in_view()
    {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        //add fadeInBottom class
        $.each(fadeInBottom, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('fadeInBottom');
            }else{
                $element.removeClass('fadeInBottom');
            }
        });

        //add fadeInTop class
        $.each(fadeInTop, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('fadeInTop');
            }else{
                $element.removeClass('fadeInTop');
            }
        });

        //add fadeInLeft class
        $.each(fadeInLeft, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('fadeInLeft');
            }else{
                $element.removeClass('fadeInLeft');
            }
        });

        //add fadeInRight class
        $.each(fadeInRight, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('fadeInRight');
            }else{
                $element.removeClass('fadeInRight');
            }
        });

        //add backgroundEffect class
        $.each( backgroundEffect, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('backgroundEffect');
            }else{
                $element.removeClass('backgroundEffect');
            }
        });

    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');

    //timeline about us : Begin
    var timelines = $('.seoplan-timeline-stories'),
        eventsMinDistance = 90;
    (timelines.length > 0) && initTimeline(timelines);
    function initTimeline(timelines){
        timelines.each(function() {
            var timeline = $(this),
                timelineComponents = {};
            timelineComponents.timelineWrapper = timeline.find('.events-wrapper');
            timelineComponents.eventsWrapper = timelineComponents.timelineWrapper.children('.events');
            timelineComponents.fillingLine = timelineComponents.eventsWrapper.children('.filling-line');
            timelineComponents.timelineEvents = timelineComponents.eventsWrapper.find('a');
            timelineComponents.timelineDates = parseDate(timelineComponents.timelineEvents);
            timelineComponents.eventsMinLapse = minLapse(timelineComponents.timelineDates);
            timelineComponents.timelineNavigation = timeline.find('.cd-timeline-navigation');
            timelineComponents.eventsContent = timeline.children('.events-content');
            setDatePosition(timelineComponents, eventsMinDistance);
            var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
            timeline.addClass('loaded');
            timelineComponents.timelineNavigation.on('click', '.next', function(event) {
                event.preventDefault();
                updateSlide(timelineComponents, timelineTotWidth, 'next');
            });
            timelineComponents.timelineNavigation.on('click', '.prev', function(event) {
                event.preventDefault();
                updateSlide(timelineComponents, timelineTotWidth, 'prev');
            });
            timelineComponents.eventsWrapper.on('click', 'a', function(event) {
                event.preventDefault();
                timelineComponents.timelineEvents.removeClass('selected');
                $(this).addClass('selected');
                updateOlderEvents($(this));
                updateFilling($(this), timelineComponents.fillingLine, timelineTotWidth);
                updateVisibleContent($(this), timelineComponents.eventsContent);
            });
            timelineComponents.eventsContent.on('swipeleft', function() {
                var mq = checkMQ();
                (mq == 'mobile') && showNewContent(timelineComponents, timelineTotWidth, 'next');
            });
            timelineComponents.eventsContent.on('swiperight', function() {
                var mq = checkMQ();
                (mq == 'mobile') && showNewContent(timelineComponents, timelineTotWidth, 'prev');
            });
            $(document).keyup(function(event) {
                if (event.which == '37' && elementInViewport(timeline.get(0))) {
                    showNewContent(timelineComponents, timelineTotWidth, 'prev');
                } else if (event.which == '39' && elementInViewport(timeline.get(0))) {
                    showNewContent(timelineComponents, timelineTotWidth, 'next');
                }
            });
        });
    }

    function updateSlide(timelineComponents, timelineTotWidth, string) {
        var translateValue = getTranslateValue(timelineComponents.eventsWrapper),
            wrapperWidth = Number(timelineComponents.timelineWrapper.css('width').replace('px', ''));
        (string == 'next') ? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth): translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
    }

    function showNewContent(timelineComponents, timelineTotWidth, string) {
        var visibleContent = timelineComponents.eventsContent.find('.selected'),
            newContent = (string == 'next') ? visibleContent.next() : visibleContent.prev();
        if (newContent.length > 0) {
            var selectedDate = timelineComponents.eventsWrapper.find('.selected'),
                newEvent = (string == 'next') ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
            updateFilling(newEvent, timelineComponents.fillingLine, timelineTotWidth);
            updateVisibleContent(newEvent, timelineComponents.eventsContent);
            newEvent.addClass('selected');
            selectedDate.removeClass('selected');
            updateOlderEvents(newEvent);
            updateTimelinePosition(string, newEvent, timelineComponents);
        }
    }

    function updateTimelinePosition(string, event, timelineComponents) {
        var eventStyle = window.getComputedStyle(event.get(0), null),
            eventLeft = Number(eventStyle.getPropertyValue('left').replace('px', '')),
            timelineWidth = Number(timelineComponents.timelineWrapper.css('width').replace('px', '')),
            timelineTotWidth = Number(timelineComponents.eventsWrapper.css('width').replace('px', ''));
        var timelineTranslate = getTranslateValue(timelineComponents.eventsWrapper);
        if ((string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < -timelineTranslate)) {
            translateTimeline(timelineComponents, -eventLeft + timelineWidth / 2, timelineWidth - timelineTotWidth);
        }
    }

    function translateTimeline(timelineComponents, value, totWidth) {
        var eventsWrapper = timelineComponents.eventsWrapper.get(0);
        value = (value > 0) ? 0 : value;
        value = ( (typeof totWidth !== 'undefined') && value < totWidth) ? totWidth : value;
        setTransformValue(eventsWrapper, 'translateX', value + 'px');
        (value === 0) ? timelineComponents.timelineNavigation.find('.prev').addClass('inactive'): timelineComponents.timelineNavigation.find('.prev').removeClass('inactive');
        (value == totWidth) ? timelineComponents.timelineNavigation.find('.next').addClass('inactive'): timelineComponents.timelineNavigation.find('.next').removeClass('inactive');
    }

    function updateFilling(selectedEvent, filling, totWidth) {
        var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
            eventLeft = eventStyle.getPropertyValue('left'),
            eventWidth = eventStyle.getPropertyValue('width');
        eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', '')) / 2;
        var scaleValue = eventLeft / totWidth;
        setTransformValue(filling.get(0), 'scaleX', scaleValue);
    }

    function setDatePosition(timelineComponents, min) {
        for ( var i = 0; i < timelineComponents.timelineDates.length; i++) {
            var distance = daydiff(timelineComponents.timelineDates[0], timelineComponents.timelineDates[i]),
                distanceNorm = Math.round(distance / timelineComponents.eventsMinLapse) + 2;
            timelineComponents.timelineEvents.eq(i).css('left', distanceNorm * min + 'px');
        }
    }

    function setTimelineWidth(timelineComponents, width) {
        var timeSpan = daydiff(timelineComponents.timelineDates[0], timelineComponents.timelineDates[timelineComponents.timelineDates.length - 1]),
            timeSpanNorm = timeSpan / timelineComponents.eventsMinLapse;
            timeSpanNorm = Math.round(timeSpanNorm) + 4;
        var totalWidth = timeSpanNorm * width;
        timelineComponents.eventsWrapper.css('width', totalWidth + 'px');
        updateFilling(timelineComponents.eventsWrapper.find('a.selected'), timelineComponents.fillingLine, totalWidth);
        updateTimelinePosition('next', timelineComponents.eventsWrapper.find('a.selected'), timelineComponents);
        return totalWidth;
    }

    function updateVisibleContent(event, eventsContent) {
        var eventDate = event.data('date'),
            visibleContent = eventsContent.find('.selected'),
            selectedContent = eventsContent.find('[data-date="' + eventDate + '"]'),
            selectedContentHeight = selectedContent.height();
            var classEnetering = 'selected enter-left';
            var classLeaving = 'leave-right';
        if (selectedContent.index() > visibleContent.index()) {
            classEnetering = 'selected enter-right';
            classLeaving = 'leave-left';
        }
        selectedContent.attr('class', classEnetering);
        visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
            visibleContent.removeClass('leave-right leave-left');
            selectedContent.removeClass('enter-left enter-right');
        });
        eventsContent.css('height', selectedContentHeight + 'px');
    }

    function updateOlderEvents(event) {
        event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
    }

    function getTranslateValue(timeline) {
        var timelineStyle = window.getComputedStyle(timeline.get(0), null),
            timelineTranslate = timelineStyle.getPropertyValue('-webkit-transform') || timelineStyle.getPropertyValue('-moz-transform') || timelineStyle.getPropertyValue('-ms-transform') || timelineStyle.getPropertyValue('-o-transform') || timelineStyle.getPropertyValue('transform');
            var translateValue = 0;
        if (timelineTranslate.indexOf('(') >= 0) {
            timelineTranslate = timelineTranslate.split('(')[1];
            timelineTranslate = timelineTranslate.split(')')[0];
            timelineTranslate = timelineTranslate.split(',');
            translateValue = timelineTranslate[4];
        }

        return Number(translateValue);
    }

    function setTransformValue(element, property, value) {
        element.style['-webkit-transform'] = property + '(' + value + ')';
        element.style['-moz-transform'] = property + '(' + value + ')';
        element.style['-ms-transform'] = property + '(' + value + ')';
        element.style['-o-transform'] = property + '(' + value + ')';
        element.style.transform = property + '(' + value + ')';
    }

    function parseDate(events) {
        var dateArrays = [];
        events.each(function() {
            var singleDate = $(this),
                dateComp = singleDate.data('date').split('T');
            var dayComp = dateComp[0].split('/'),
                timeComp = ['0', '0'];
            if (dateComp.length > 1) {
                dayComp = dateComp[0].split('/'),
                timeComp = dateComp[1].split(':');
            } else if (dateComp[0].indexOf(':') >= 0) {
                dayComp = ['2000', '0', '0'],
                 timeComp = dateComp[0].split(':');
            }
            var newDate = new Date(dayComp[2], dayComp[1] - 1, dayComp[0], timeComp[0], timeComp[1]);
            dateArrays.push(newDate);
        });
        return dateArrays;
    }

    function daydiff(first, second) {
        return Math.round((second - first));
    }

    function minLapse(dates) {
        var dateDistances = [];
        for (var i = 1; i < dates.length; i++) {
            var distance = daydiff(dates[i - 1], dates[i]);
            dateDistances.push(distance);
        }
        return Math.min.apply(null, dateDistances);
    }

    function elementInViewport(el) {
        var top = el.offsetTop;
        var left = el.offsetLeft;
        var width = el.offsetWidth;
        var height = el.offsetHeight;
        while (el.offsetParent) {
            el = el.offsetParent;
            top += el.offsetTop;
            left += el.offsetLeft;
        }
        return (top < (window.pageYOffset + window.innerHeight) && left < (window.pageXOffset + window.innerWidth) && (top + height) > window.pageYOffset && (left + width) > window.pageXOffset);
    }
    function checkMQ() {
        return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, '').replace(/"/g, '');
    }

} )(jQuery);